const CACHE_NAME = 'app-cache-v1';
const urlsToCache = [
  '/',
  '/css/output.css',
  '/js/flowbite.js',
  '/icon512_maskable.png',
  '/icon512_rounded.png'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request)
      .then((response) => response || fetch(event.request))
  );
});
