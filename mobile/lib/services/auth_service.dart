class AuthService {
  static bool isLoggedIn = false;
  static Map<String, dynamic>? currentUser;

  static void login(Map<String, dynamic> userData) {
    isLoggedIn = true;
    currentUser = userData;
  }

  static void logout() {
    isLoggedIn = false;
    currentUser = null;
  }
}