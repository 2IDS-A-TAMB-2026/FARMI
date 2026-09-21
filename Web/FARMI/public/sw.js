const CACHE_NAME = 'farmi-pwa-cache-v1';
const urlsToCache = [
  '/',
  '/assets/css/bootstrap.min.css',
  '/assets/css/dashboard/style.css',
  '/assets/css/dashboard/style_responsivo.css',
  '/assets/img/icon-192.png',
  '/assets/img/icon-512.png'
];

// Instalação do Service Worker e Cache dos recursos
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(urlsToCache);
    })
  );
  self.skipWaiting();
});

// Ativação do Service Worker e Limpeza de caches antigos
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  self.clients.claim();
});

// Interceptação de requisições (Estratégia Network First com Fallback para Cache)
self.addEventListener('fetch', (event) => {
  event.respondWith(
    fetch(event.request)
      .then((response) => {
        // Se a resposta for válida, clona e atualiza no cache
        if (response && response.status === 200 && response.type === 'basic') {
          const responseToCache = response.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, responseToCache);
          });
        }
        return response;
      })
      .catch(() => {
        // Caso esteja offline, tenta recuperar do cache
        return caches.match(event.request);
      })
  );
});