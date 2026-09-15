class Crop {
  final String id;
  final String name;
  final String plantingDate;
  final int productiveCycle;
  final double area;
  final String type;
  final String sensorLight;
  final String sensorClimateTemperature;
  final String sensorClimateHumidity;
  final String sensorSoil;
  final String status;
  final String farmId;
  final String farmName;
  final String health;
  final String season;

  Crop({
    required this.id,
    required this.name,
    required this.plantingDate,
    required this.productiveCycle,
    required this.area,
    required this.type,
    required this.sensorLight,
    required this.sensorClimateTemperature,
    required this.sensorClimateHumidity,
    required this.sensorSoil,
    required this.status,
    required this.farmId,
    required this.farmName,
    required this.health,
    required this.season,
  });

  factory Crop.fromJson(Map<String, dynamic> json) {
    return Crop(
  id: json['ID_CULTURA']?.toString() ?? '',
  name: json['NOME_CULTURA']?.toString() ?? 'Sem nome',
  plantingDate: json['DATA_PLANTIO']?.toString() ?? '',

  productiveCycle: int.tryParse(
    json['CICLO_PRODUTIVO']?.toString() ?? '0',
  ) ?? 0,

  area: double.tryParse(
    json['AREA_CULTIVADA']?.toString() ?? '0',
  ) ?? 0.0,

  type: json['TIPO_CULTURA']?.toString() ?? '',
  sensorLight: json['SENSOR_LUZ']?.toString() ?? '',
  sensorClimateTemperature:
      json['SENSOR_CLIMA_TEMPO']?.toString() ?? '',
  sensorClimateHumidity:
      json['SENSOR_CLIMA_UMIDADE']?.toString() ?? '',
  sensorSoil: json['SENSOR_SOLO']?.toString() ?? '',

  status: json['STATUS']?.toString() ?? '',

  farmId: json['FK_ID_FAZENDA']?.toString() ?? '',
  farmName: json['NOME_FAZENDA']?.toString() ?? '',

  health: json['SAUDE']?.toString() ?? 'good',
  season: json['SAFRA']?.toString() ?? '',
);
  }
}