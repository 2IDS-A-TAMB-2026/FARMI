import 'dart:convert';
import 'package:http/http.dart' as http;
import '../models/crop.dart';
import '../models/alert_model.dart';
import '../models/farm.dart';
import 'auth_service.dart';
import '../models/sensor.dart';

class ApiService {
  // Rota base
  static const String baseUrl =
      'http://10.141.130.78/FARMI/public/index.php/api';

  static Future<Map<String, dynamic>> login(
      String email, String password) async {
    final url = Uri.parse('$baseUrl/login');

    final response = await http.post(
      url,
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      body: jsonEncode({
        'email': email,
        'senha': password,
      }),
    );

    if (response.statusCode == 200) {
      return jsonDecode(response.body);
    } else if (response.statusCode == 401 || response.statusCode == 404) {
      final body = jsonDecode(response.body);
      throw Exception(body['message'] ?? 'E-mail ou senha incorretos.');
    } else {
      throw Exception(
          'Erro ao conectar ao servidor. Código: ${response.statusCode}');
    }
  }

  static Future<List<Farm>> getFarms() async {
    try {
      final token = AuthService.currentUser?['token'] ?? '';

      final cpf = AuthService.currentUser?['cpf'] ??
          AuthService.currentUser?['CPF'] ??
          AuthService.currentUser?['usuario_cpf'] ??
          '';

      final Map<String, String> headers = {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      };

      if (token.toString().isNotEmpty) {
        headers['Authorization'] = 'Bearer $token';
      }

      final queryParam = cpf.toString().isNotEmpty
          ? '?cpf=${Uri.encodeComponent(cpf.toString())}'
          : '';

      final url = Uri.parse('$baseUrl/fazendas$queryParam');

      print('--> REQUISIÇÃO: $url');

      final response = await http.get(
        url,
        headers: headers,
      );

      print('<-- STATUS CODE: ${response.statusCode}');
      print('<-- BODY: ${response.body}');

      if (response.statusCode != 200) {
        throw Exception(
          'Erro ${response.statusCode}: ${response.body}',
        );
      }

      final decodedBody = jsonDecode(response.body);

      List<dynamic> listData = [];

      if (decodedBody is Map<String, dynamic>) {
        final data = decodedBody['data'];

        if (data is List) {
          listData = data;
        }
      } else if (decodedBody is List) {
        listData = decodedBody;
      }

      print('TOTAL RECEBIDAS DA API: ${listData.length}');

      final List<Farm> farms = [];

      for (final json in listData) {
        try {
          print('--------------------------------');
          print('JSON DA FAZENDA: $json');

          final farm = Farm.fromJson(
            Map<String, dynamic>.from(json),
          );

          print('✅ Fazenda convertida:');
          print('ID: ${farm.id}');
          print('Nome: ${farm.name}');
          print('Área: ${farm.area}');
          print('Local: ${farm.location}');

          farms.add(farm);
        } catch (e, stack) {
          print('❌ ERRO AO CONVERTER FAZENDA');
          print('JSON: $json');
          print('ERRO: $e');
          print(stack);
        }
      }

      print('================================');
      print('FAZENDAS VÁLIDAS: ${farms.length}');
      print('================================');

      return farms;
    } catch (e, stack) {
      print('❌ ERRO EM GETFARMS: $e');
      print(stack);
      rethrow;
    }
  }

// Dentro da classe ApiService:
  static Future<List<Sensor>> getSensors() async {
    try {
      final url = Uri.parse('$baseUrl/sensores');

      print('--> REQUISIÇÃO SENSORES: $url');

      final token = AuthService.currentUser?['token'] ?? '';
      final Map<String, String> headers = {
        'Accept': 'application/json',
      };
      if (token.toString().isNotEmpty) {
        headers['Authorization'] = 'Bearer $token';
      }

      final response = await http.get(
        url,
        headers: headers,
      );

      if (response.statusCode != 200) {
        throw Exception('Erro ${response.statusCode}: ${response.body}');
      }

      final decodedBody = jsonDecode(response.body);

      List<dynamic> listData = [];

      if (decodedBody is Map<String, dynamic>) {
        final data = decodedBody['data'];
        if (data is List) {
          listData = data;
        }
      } else if (decodedBody is List) {
        listData = decodedBody;
      }

      final List<Sensor> allSensors = [];

      for (final json in listData) {
        try {
          final sensor = Sensor.fromJson(Map<String, dynamic>.from(json));
          allSensors.add(sensor);
        } catch (e, stack) {
          print('❌ ERRO AO CONVERTER SENSOR: $json');
        }
      }

      // ==========================================
      // 1. DEDUPLICAÇÃO (Remove registros repetidos trazidos das medições)
      // ==========================================
      final Map<String, Sensor> uniqueSensorsMap = {};
      for (var sensor in allSensors) {
        if (sensor.id.isNotEmpty && !uniqueSensorsMap.containsKey(sensor.id)) {
          uniqueSensorsMap[sensor.id] = sensor;
        }
      }
      final uniqueSensors = uniqueSensorsMap.values.toList();

      // ==========================================
      // 2. FILTRO POR CULTURAS DO USUÁRIO
      // ==========================================
      final myCrops = await getCrops();
      final myCropIds = myCrops.map((crop) => crop.id.toString()).toSet();

      final filteredSensors = uniqueSensors.where((sensor) {
        return myCropIds.contains(sensor.cropId.toString());
      }).toList();

      print('TOTAL DE SENSORES FILTRADOS: ${filteredSensors.length}');

      return filteredSensors;
    } catch (e, stack) {
      print('❌ ERRO EM GETSENSORES: $e');
      print(stack);
      rethrow;
    }
  }

  static Future<List<Crop>> getCrops() async {
    try {
      final url = Uri.parse('$baseUrl/culturas');

      print('--> REQUISIÇÃO CULTURAS: $url');

      // É uma boa prática enviar o token de autorização, mesmo se a API não estiver exigindo
      final token = AuthService.currentUser?['token'] ?? '';
      final Map<String, String> headers = {
        'Accept': 'application/json',
      };
      if (token.toString().isNotEmpty) {
        headers['Authorization'] = 'Bearer $token';
      }

      final response = await http.get(
        url,
        headers: headers,
      );

      print('<-- STATUS CULTURAS: ${response.statusCode}');

      if (response.statusCode != 200) {
        throw Exception(
          'Erro ${response.statusCode}: ${response.body}',
        );
      }

      final decodedBody = jsonDecode(response.body);

      List<dynamic> listData = [];

      if (decodedBody is Map<String, dynamic>) {
        final data = decodedBody['data'];

        if (data is List) {
          listData = data;
        }
      } else if (decodedBody is List) {
        listData = decodedBody;
      }

      print('TOTAL DE CULTURAS DA API: ${listData.length}');

      final List<Crop> allCrops = [];

      for (final json in listData) {
        try {
          final crop = Crop.fromJson(
            Map<String, dynamic>.from(json),
          );
          allCrops.add(crop);
        } catch (e, stack) {
          print('❌ ERRO AO CONVERTER CULTURA: $json');
        }
      }

      // ==========================================
      // INÍCIO DO FILTRO LOCAL
      // ==========================================

      // 1. Busca as fazendas do usuário logado (este método já filtra pelo CPF)
      final myFarms = await getFarms();

      // 2. Extrai apenas os IDs das fazendas para um Set (o uso do toString() evita erros de tipo)
      final myFarmIds = myFarms.map((farm) => farm.id.toString()).toSet();

      // 3. Filtra a lista de culturas para manter APENAS as que pertencem às fazendas do usuário
      final filteredCrops = allCrops.where((crop) {
        return myFarmIds.contains(crop.farmId.toString());
      }).toList();

      print('TOTAL DE CULTURAS APÓS O FILTRO: ${filteredCrops.length}');

      return filteredCrops;
      // ==========================================
    } catch (e, stack) {
      print('❌ ERRO EM GETCROPS: $e');
      print(stack);
      rethrow;
    }
  }

  static Future<List<AlertModel>> getAlerts() async {
    try {
      final url = Uri.parse('$baseUrl/alertas');
      final token = AuthService.currentUser?['token'] ?? '';
      final Map<String, String> headers = {
        'Accept': 'application/json',
      };
      if (token.toString().isNotEmpty) {
        headers['Authorization'] = 'Bearer $token';
      }

      final response = await http.get(url, headers: headers);

      if (response.statusCode != 200) {
        throw Exception('Erro ${response.statusCode}: ${response.body}');
      }

      final decodedBody = jsonDecode(response.body);

      List<dynamic> listData = [];
      if (decodedBody is Map<String, dynamic>) {
        final data = decodedBody['data'];
        if (data is List) listData = data;
      } else if (decodedBody is List) {
        listData = decodedBody;
      }

      // 1. Converte JSON para objetos AlertModel
      final List<AlertModel> rawAlerts = [];
      for (final json in listData) {
        try {
          rawAlerts.add(AlertModel.fromJson(Map<String, dynamic>.from(json)));
        } catch (e) {
          print('❌ ERRO AO CONVERTER ALERTA: $json');
        }
      }

      // 2. DEDUPLICAÇÃO (Remove repetidos vindos de JOINs do banco)
      final Map<String, AlertModel> uniqueAlertsMap = {};
      for (var alert in rawAlerts) {
        // Se o ID for vazio, gera uma chave composta baseada no título, cultura e data
        final uniqueKey = alert.id.isNotEmpty && alert.id != '0'
            ? alert.id
            : '${alert.title}_${alert.cropName}_${alert.sensorId}_${alert.createdDate}';

        if (!uniqueAlertsMap.containsKey(uniqueKey)) {
          uniqueAlertsMap[uniqueKey] = alert;
        }
      }
      final uniqueAlerts = uniqueAlertsMap.values.toList();

      // 3. Obtém dados do usuário logado para filtrar
      final myFarms = await getFarms();
      final myFarmNames = myFarms
          .map((f) => f.name.toLowerCase().trim())
          .where((name) => name.isNotEmpty)
          .toSet();

      final myCrops = await getCrops();
      final myCropNames = myCrops
          .map((c) => c.name.toLowerCase().trim())
          .where((name) => name.isNotEmpty)
          .toSet();

      final mySensors = await getSensors();
      final mySensorIds = mySensors
          .map((s) => s.id.toString())
          .where((id) => id.isNotEmpty && id != '0')
          .toSet();

      // 4. Aplica os filtros de propriedade
      final filteredAlerts = uniqueAlerts.where((alert) {
        final hasFarm = alert.farmName != null && alert.farmName!.trim().isNotEmpty;
        if (hasFarm && !myFarmNames.contains(alert.farmName!.toLowerCase().trim())) {
          return false;
        }

        final hasCrop = alert.cropName != null && alert.cropName!.trim().isNotEmpty;
        if (hasCrop && !myCropNames.contains(alert.cropName!.toLowerCase().trim())) {
          return false;
        }

        final hasSensor = alert.sensorId != null && alert.sensorId!.trim().isNotEmpty && alert.sensorId != '0';
        if (hasSensor && !mySensorIds.contains(alert.sensorId.toString())) {
          return false;
        }

        return hasFarm || hasCrop || hasSensor;
      }).toList();

      print('TOTAL ALERTAS BRUTOS: ${rawAlerts.length}');
      print('TOTAL UNIFICADOS (SEM DUPLICADOS): ${uniqueAlerts.length}');
      print('TOTAL FILTRADOS PARA O USUÁRIO: ${filteredAlerts.length}');

      return filteredAlerts;
    } catch (e, stack) {
      print('❌ ERRO EM GETALERTAS: $e');
      print(stack);
      rethrow;
    }
  }

  static Future<void> markAlertAsRead(String id) async {
    final response = await http.put(Uri.parse('$baseUrl/alertas/$id/read'));
    if (response.statusCode != 200) {
      throw Exception('Falha ao marcar alerta como lido');
    }
  }

  static Future<void> markAllAlertsAsRead() async {
    final response = await http.put(Uri.parse('$baseUrl/alertas/read-all'));
    if (response.statusCode != 200) {
      throw Exception('Falha ao marcar todos alertas como lidos');
    }
  }
}
