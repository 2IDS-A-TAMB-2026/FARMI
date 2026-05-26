class Sensor {
  final String id;
  final String name;
  final String type;
  final String status;
  final double? currentValue;
  final String? unit;
  final String? location;
  final double? alertMin;
  final double? alertMax;

  Sensor({
    required this.id,
    required this.name,
    required this.type,
    required this.status,
    this.currentValue,
    this.unit,
    this.location,
    this.alertMin,
    this.alertMax,
  });

  factory Sensor.fromJson(Map<String, dynamic> json) => Sensor(
        id: json['id'] ?? '',
        name: json['name'] ?? '',
        type: json['type'] ?? '',
        status: json['status'] ?? 'inactive',
        currentValue: (json['current_value'] as num?)?.toDouble(),
        unit: json['unit'],
        location: json['location'],
        alertMin: (json['alert_min'] as num?)?.toDouble(),
        alertMax: (json['alert_max'] as num?)?.toDouble(),
      );
}