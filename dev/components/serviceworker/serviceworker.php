<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            <?php if (!is_user_logged_in()) { ?>
                navigator.serviceWorker.register('/serviceworker.js').then(function(registration) {
                    //* Registration was successful
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function(err) {
                    //* Registration failed
                    console.log('ServiceWorker registration failed: ', err);
                });
            <?php } else { ?>
                navigator.serviceWorker.getRegistrations().then(function(registrations) {
                    for (let registration of registrations) {
                        registration.unregister().then(function(success) {
                            if (success) {
                                console.log('ServiceWorker unregistration successful.');
                            } else {
                                console.log('ServiceWorker unregistration failed.');
                            }
                        });
                    }
                })
            <?php } ?>
        });
    }
</script>
