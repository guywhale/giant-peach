/* eslint-disable no-restricted-globals */
const CACHE = 'light-1.0.0';

self.addEventListener('install', evt => {
    self.skipWaiting();
    evt.waitUntil(precache());
});

self.addEventListener('fetch', evt => {
    const { request } = evt;

    //* Ignore all requests to other domains.
    if (!request.url.includes(self.location.hostname)) {
        return;
    }

    //* Ignore requests for admin-related URLs
    if (request.url.includes('/wp-admin')) {
        return;
    }

    if (request.url.includes('/wp-includes')) {
        return;
    }

    if (request.url.includes('/wp-json')) {
        return;
    }

    //* Ignore non-GET requests
    if (request.method !== 'GET') {
        return;
    }

    //* Ignore video requests because of Safari's range bug
    // ? https://philna.sh/blog/2018/10/23/service-workers-beware-safaris-range-request/
    if (request.url.match(/\.(mp4)$/)) {
        return;
    }

    evt.respondWith(fromCache(request));
});

//* Delete old caches
function precache() {
    caches.keys().then(names => {
        [].forEach.call(names, name => {
            if (name !== CACHE) {
                caches.delete(name);
            }
        });
    });

    //* Cache offline page and homepage
    //* Cache everything
    return caches.open(CACHE).then(cache => cache.addAll([
        '/offline/',
        '/'
    ]));
}

function fromCache(request) {
    //* Network first: for pages
    if (request.destination === 'document') {
        return fetch(request).then(response => {
            const responseClone = response.clone();

            caches.open(CACHE).then(cache => {
                cache.put(request, responseClone);
            });

            return response;
        }).catch(() => caches.open(CACHE).then(cache => cache.match(request).then(matching => {
            if (matching) {
                return matching;
            }
            return caches.match('/offline/');
        })));
    }

    //* Cache first: For everything else
    return caches.open(CACHE).then(cache => cache.match(request).then(matching => {
        if (matching) {
            return matching;
        }
        //* Update cache if online
        return fetch(request).then(response => {
            const responseClone = response.clone();
            caches.open(CACHE).then(c => {
                c.put(request, responseClone);
            });
            return response;
        });
    }).catch(() => {
        //* Serve offline asset if not online
        if (request.url.match(/\.(jpe?g|png|gif|svg)$/)) {
            return missingImage(request);
        }
        // eslint-disable-next-line no-useless-return, consistent-return
        return;
    }));
}

function missingImage(request) {
    if (navigator.onLine === false) {
        return new Response(`
            <svg role="img" aria-labelledby="offline-title" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
                <title id="offline-title">Offline</title>
                <g fill="none" fill-rule="evenodd">
                    <path fill="#D8D8D8" d="M0 0h400v300H0z"/>
                    <text fill="#9B9B9B" font-family="Helvetica Neue,Arial,Helvetica,sans-serif" font-size="72" font-weight="bold">
                        <tspan x="93" y="172">offline</tspan>
                    </text>
                </g>
            </svg>`, {
            headers: {
                'Content-Type': 'image/svg+xml',
                'Cache-Control': 'no-store'
            }
        });
    }
    return fetch(request).then(response => response);
}
