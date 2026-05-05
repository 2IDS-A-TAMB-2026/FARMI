class AlertModel {
  final String id;
  final String title;
  final String? message;
  final String type;
  final String severity;
  final String? sensorName;
  final bool isRead;
  final DateTime? createdDate;

  AlertModel({
    required this.id,
    required this.title,
    this.message,
    required this.type,
    required this.severity,
    this.sensorName,
    required this.isRead,
    this.createdDate,
  });

  factory AlertModel.fromJson(Map<String, dynamic> json) => AlertModel(
        id: json['id'] ?? '',
        title: json['title'] ?? '',
        message: json['message'],
        type: json['type'] ?? 'general',
        severity: json['severity'] ?? 'medium',
        sensorName: json['sensor_name'],
        isRead: json['is_read'] ?? false,
        createdDate: json['created_date'] != null
            ? DateTime.tryParse(json['created_date'])
            : null,
      );
}