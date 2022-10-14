const staticJungle = "dev-esgoto"
const assets = 
[
    // JS
    "js/app.js",
    "js/core.js",
    "js/jquery-1.12.4.min.js",

    // CSS
    "css/app.css",
    "css/layout.css",
];

self.addEventListener("install", installEvent => 
{
    installEvent.waitUntil(
        caches.open(staticJungle).then(cache => 
        {
            cache.addAll(assets);
        })
    );
});

self.addEventListener("fetch", fetchEvent => 
{
    fetchEvent.respondWith(
        caches.match(fetchEvent.request).then(res => 
        {
            return res || fetch(fetchEvent.request);
        })
    );
});