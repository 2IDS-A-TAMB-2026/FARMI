class AlertModel {
  final String id;
  final String title;
  final String? message;
  final String type;
  final String severity;
  final String? sensorId;
  final String? sensorName;
  final String? cropName;
  final String? farmName;
  final String status;
  final bool isRead;
  final DateTime? createdDate;

  AlertModel({
    required this.id,
    required this.title,
    this.message,
    required this.type,
    required this.severity,
    this.sensorId,
    this.sensorName,
    this.cropName,
    this.farmName,
    this.status = 'Ativo',
    required this.isRead,
    this.createdDate,
  });

  factory AlertModel.fromJson(Map<String, dynamic> json) {
    final rawStatus = json['status']?.toString() ??
        json['STATUS']?.toString() ??
        json['STATUS_ALERTA']?.toString() ??
        'Ativo';

    return AlertModel(
      id: json['id']?.toString() ?? json['ID_ALERTA']?.toString() ?? '',
      title: json['title']?.toString() ??
          json['TIPO_ALERTA']?.toString() ??
          json['TITULO']?.toString() ??
          'Alerta',
      message: json['message']?.toString() ??
          json['DESCRICAO']?.toString() ??
          json['MENSAGEM']?.toString(),
      type: json['type']?.toString() ??
          json['TIPO_ALERTA']?.toString() ??
          'general',
      severity: json['severity']?.toString() ??
          json['NIVEL_GRAVIDADE']?.toString() ??
          json['GRAVIDADE']?.toString() ??
          'medium',
      sensorId: json['sensor_id']?.toString() ??
          json['FK_ID_SENSOR']?.toString() ??
          json['ID_SENSOR']?.toString(),
      sensorName: json['sensor_name']?.toString() ??
          json['NOME_SENSOR']?.toString() ??
          json['TIPO_SENSOR']?.toString(),
      cropName: json['crop_name']?.toString() ??
          json['NOME_CULTURA']?.toString() ??
          json['CULTURA']?.toString(),
      farmName: json['farm_name']?.toString() ??
          json['NOME_FAZENDA']?.toString() ??
          json['FAZENDA']?.toString(),
      status: rawStatus,
      isRead: json['is_read'] == true ||
          json['is_read'] == 1 ||
          json['STATUS_LIDO'] == 1 ||
          rawStatus.toLowerCase() == 'lido',
      createdDate: json['created_date'] != null
          ? DateTime.tryParse(json['created_date'].toString())
          : json['DATA_HORA'] != null
              ? DateTime.tryParse(json['DATA_HORA'].toString())
              : null,
    );
  }

  get createdAt => null;
}