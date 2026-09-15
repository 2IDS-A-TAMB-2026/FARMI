class Sensor {
  final String id;
  final String name;
  final String type;
  final String status;
  final double? currentValue;
  final String unit;
  final String? location;
  final String date;
  final String cropId;

  Sensor({
    required this.id,
    required this.name,
    required this.type,
    required this.status,
    this.currentValue,
    required this.unit,
    this.location,
    required this.date,
    required this.cropId,
  });

  factory Sensor.fromJson(Map<String, dynamic> json) {
  return Sensor(
    id: json['ID_SENSOR']?.toString() ?? json['FK_ID_SENSOR']?.toString() ?? json['id']?.toString() ?? '',
    name: json['NOME_SENSOR']?.toString() ?? json['name']?.toString() ?? 'Sensor Sem Nome',
    type: json['TIPO_SENSOR']?.toString() ?? json['type']?.toString() ?? '',
    //  Adicionada a chave STATUS_SENSOR que vem do PHP
    status: json['STATUS_SENSOR']?.toString() ?? json['STATUS']?.toString() ?? json['status']?.toString() ?? 'Inativo',
    currentValue: double.tryParse(json['VALOR']?.toString() ?? json['VALOR_ATUAL']?.toString() ?? json['current_value']?.toString() ?? ''),
    unit: json['UNIDADE_MEDIDA']?.toString() ?? json['UNIDADE']?.toString() ?? json['unit']?.toString() ?? '',
    location: json['LOCALIZACAO']?.toString() ?? json['location']?.toString(),
    date: json['DATA_INSTALACAO']?.toString() ?? json['DATA']?.toString() ?? json['date']?.toString() ?? '',
    cropId: json['FK_ID_CULTURA']?.toString() ?? json['ID_CULTURA']?.toString() ?? json['crop_id']?.toString() ?? '',
  );
}
}