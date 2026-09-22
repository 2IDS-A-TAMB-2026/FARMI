class Sensor {
  final String id;
  final String name;
  final String type;
  final String status;
  final double? currentValue;
  final String unit;
  final String? location;
  final String date;          // Data de instalação
  final String updatedAt;     // ÚLTIMA_LEITURA / DATA_ATUALIZACAO
  final String cropId;
  final String cropName;

  Sensor({
    required this.id,
    required this.name,
    required this.type,
    required this.status,
    this.currentValue,
    required this.unit,
    this.location,
    required this.date,
    required this.updatedAt,
    required this.cropId,
    required this.cropName,
  });

  // Converte Strings com vírgula (ex: "24,0") para double de forma segura
  static double? _parseValue(dynamic val) {
    if (val == null) return null;
    if (val is num) return val.toDouble();
    final str = val.toString().replaceAll(',', '.').trim();
    return double.tryParse(str);
  }

  factory Sensor.fromJson(Map<String, dynamic> json) {
    return Sensor(
      id: json['ID_SENSOR']?.toString() ?? json['FK_ID_SENSOR']?.toString() ?? json['id']?.toString() ?? '',
      name: json['NOME_SENSOR']?.toString() ?? json['name']?.toString() ?? 'Sensor Sem Nome',
      type: json['TIPO_SENSOR']?.toString() ?? json['type']?.toString() ?? '',
      status: json['STATUS_SENSOR']?.toString() ?? json['STATUS']?.toString() ?? json['status']?.toString() ?? 'Inativo',
      currentValue: _parseValue(json['VALOR'] ?? json['VALOR_ATUAL'] ?? json['current_value']),
      unit: json['UNIDADE_MEDIDA']?.toString() ?? json['UNIDADE']?.toString() ?? json['unit']?.toString() ?? '',
      location: json['LOCALIZACAO']?.toString() ?? json['location']?.toString(),
      date: json['DATA_INSTALACAO']?.toString() ?? json['date']?.toString() ?? '',
      updatedAt: json['DATA_ATUALIZACAO']?.toString() ?? json['DATA']?.toString() ?? '--',
      cropId: json['FK_ID_CULTURA']?.toString() ?? json['ID_CULTURA']?.toString() ?? json['crop_id']?.toString() ?? '',
      cropName: json['NOME_CULTURA']?.toString() ?? '',
    );
  }

  // Helper para exibir leitura + unidade (ex: "24.0 °C")
  String get displayReading {
    if (currentValue == null) return '--';
    final valStr = currentValue == currentValue!.roundToDouble()
        ? currentValue!.toInt().toString()
        : currentValue!.toStringAsFixed(1);
    return unit.isNotEmpty ? '$valStr $unit' : valStr;
  }
}