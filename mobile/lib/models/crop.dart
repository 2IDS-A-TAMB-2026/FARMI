class Crop {
  final String id;
  final String name;
  final String type;
  final String? plantingDate;
  final String? harvestDate;
  final double? area;
  final String? irrigationType;
  final String status;
  final String health;
  final String? season;
  final String? notes;

  Crop({
    required this.id,
    required this.name,
    required this.type,
    this.plantingDate,
    this.harvestDate,
    this.area,
    this.irrigationType,
    required this.status,
    required this.health,
    this.season,
    this.notes,
  });

  factory Crop.fromJson(Map<String, dynamic> json) => Crop(
        id: json['id'] ?? '',
        name: json['name'] ?? '',
        type: json['type'] ?? '',
        plantingDate: json['planting_date'],
        harvestDate: json['harvest_date'],
        area: (json['area'] as num?)?.toDouble(),
        irrigationType: json['irrigation_type'],
        status: json['status'] ?? 'planting',
        health: json['health'] ?? 'good',
        season: json['season'],
        notes: json['notes'],
      );
}