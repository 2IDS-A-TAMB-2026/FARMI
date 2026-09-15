class Farm {
  final String id;
  final String name;
  final String latitude;
  final String longitude;
  final String logradouro;
  final String numero;
  final String cep;
  final double area;

  Farm({
    required this.id,
    required this.name,
    required this.latitude,
    required this.longitude,
    required this.logradouro,
    required this.numero,
    required this.cep,
    required this.area,
  });

  String get location {
    if (logradouro.isEmpty && numero.isEmpty) {
      return 'Localização não informada';
    }

    if (numero.isEmpty) {
      return logradouro;
    }

    return '$logradouro, $numero';
  }

  factory Farm.fromJson(Map<String, dynamic> json) {
    return Farm(
      id: json['ID_FAZENDA']?.toString() ?? '',
      
      name: json['NOME']?.toString() ?? 'Sem nome',
      
      latitude: json['LATITUDE']?.toString() ?? '',
      
      longitude: json['LONGITUDE']?.toString() ?? '',
      
      logradouro: json['LOGRADOURO']?.toString() ?? '',
      
      numero: json['NUMERO']?.toString() ?? '',
      
      cep: json['CEP']?.toString() ?? '',
      
      area: _parseDouble(json['AREA_TOTAL']),
    );
  }

  static double _parseDouble(dynamic value) {
    if (value == null) return 0.0;

    if (value is num) {
      return value.toDouble();
    }

    final text = value.toString().trim();

    if (text.isEmpty) return 0.0;

    return double.tryParse(text.replaceAll(',', '.')) ?? 0.0;
  }
}