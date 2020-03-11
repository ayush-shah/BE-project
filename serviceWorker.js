var CACHE_NAME = 'my-site-cache-v1';
var urlsToCache = [
    "./",
    "./index.php",
    "./manifest.json",
    "./phpfiles.php",
    "./afterLogin.php",
    "./Scripts and Sheets/main.css",
    "./Scripts and Sheets/main.js",
    "./Images/Img1.jpg",
    "./Images/Img2.jpg",
    "./Images/Img3.jpg",
    "./Images/Img4.jpg",
    "./Images/Img5.jpg",
    "./Images/Img6.jpg",
    "./Images/Img7.jpg",
    "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js",
    "https://fonts.googleapis.com/css?family=Spartan:400,600,800,900&display=swap"
];

self.addEventListener('install', function (event) {
    // Perform install steps
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(function (cache) {
                console.log('Opened cache');
                return cache.addAll(urlsToCache);
            })
    );
});
self.addEventListener('fetch', function (event) {
    console.log(event.request.url);
    event.respondWith(
        caches.match(event.request).then(function (response) {
            return response || fetch(event.request);
        })
    );
});
