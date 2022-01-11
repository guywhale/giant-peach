![sobold-logo](https://media-exp1.licdn.com/dms/image/C560BAQG2lLRj7RMBUw/company-logo_200_200/0/1558692938189?e=2159024400&v=beta&t=GxYjl9SZ3BW0pCXUH8K9sDpzvaIlwW5a9PNjv70Ph8c)

# Light Theme ⚡

SoBold's Modern WordPress Theme

> ## Requirements
- Node v16 (Through NVM)
  - Gulp CLI
  - Editorconfig
- PHP
- MySQL
- Composer
  - squeezelab/php_codesniffer

---

> ### Theme Setup
1. Create a Local site
2. Launch 'Git Bash' and navigate into the Local site WordPress theme folder
3. Get the theme from github

     ```
    git clone https://github.com/SoBold-Dev/Light.git
    ``` 
    
4. Navigate into the new 'Light' folder
5. Intizialise the theme by running 
    ```
    node run init
    ``` 
    or 
    ```
    npm i && composer i && gulp
    ```

6. Set the 'BrowserSync Proxy'

    ```
   gulp initEnv -browsersyncproxy {local.site}
   ```

7. To build theme & start browsersync run
   
    ```
   gulp watch
   ```


> ### Creating Component
1. Components are made with a Gulp task. To make a component...

    ```php
   gulp createComponent --component {component-name}
   ```
2. This will create a sub-folder inside /dev/components/
3. In the terminal navigate into the new components folder
4. You now need to copy the acf.php filer to the new component

    ```php
   cp /sample/acf.php {new-component-path}
   ```
5. Inside `'acf.php'` you need to fill out all the fields as per the component you are making
6. Uncomment  
   
   ```php
   acf_register_block($blockArgs);
   ```
7. Inside of WordPress create a new field group in ACF
8. Select the 'Location' as 'Block' and then the block as the new component you just created.
9.  It will then appear in the Gutenburg block editor
10. Make sure to select 'Blocks' as the template in the page attributes

    > #### Component Setup
    1. Define Variables after creating ACF block
        ```php
        [
            'ACF_Variable_Name' => $defineVariable
        ] = $args;
        ```
    2. Then access with the defined variables

        ```php
        <?= $defineVariable ?>
        ```

    > #### Component Functions
    1. Setup the functions file by adding a filter

        ```php
        add_filter('light/render/build/components/{component-name}', function($args){
                return $args;
            });
        ```
> ### Buttons
1. Navigate to `'variables.json'`
2. Inside the variables file, look for the 'button' objects
3. Create a new one, or modify the exisiting to what button you require.
4. To assign the styles to a button, add the class `'button--{name}'`

> ### DB Sync
1. Setup new project in DeployHQ, if not done so already.
2. `'.env.js.sample'` copy contents to `'.env.js'`
3. Fill out the details inside the new .js file
4. Set (Windows PORT or Mac SOCKET) from local config
5. Enter remote database details (Get from Cloudways)
6. Run the bash command to download the remote site to the local

    ```
    bash /dbsync/db-sync.sh
    ```
    if on mac run instead 

    ```
    bash /dbsync/db-sync-mac.sh
    ```
7. Replace URLS from dev site back to local.
   
   ```
   wp search-replace https://{devsite}.sobold.dev https://local.site
   ```

> ### AJAX Setup

1. Add field inside of ACF Field group under 'Layout'. Name is `Ajax` and type of `True/False`
2. Publish and then navigate to the component and enable the AJAX option to `true`
3. In the Light theme, if not done so already, navigate to `/core/config.php` and update AJAX to true
   
   ```php
   define('LIGHT_AJAX_REQUIRED', true);
   ```
4. Copy the `ajax.php` & `ajax.js` from `/dev/components/sample/` to `/dev/components/{component}/`
5. In the `ajax.php` file change the endpoint to something custom, also change the method based on the requirements you need i.e POST or GET. Finally make sure you rename the callback and then replace the name of the function underneath with the one you just set.
   ```php
    add_action('rest_api_init', function () {
        register_rest_route('light/v1', '/custom-endpoint/', [
            'methods'  => 'POST',
            'callback' => 'restFunction'
        ]);
    });
    ```
6. In the callback function write the PHP code required for the AJAX function. Make sure to add it to the data array in the `$response` variable and update the status code [accordingly](https://http.cat). 
7. In the `ajax.js` file, update the new endpoint in the AJAX url field. Also define the data you want to input into the request.

---

> ### Gulp Tasks
- `gulp initEnv` Initizalises the gulp environment
    - `-browsersyncproxy` = Local URL
- `gulp createComponent` Create Components
    - `-component` = Component Name
- `gulp browsersync` Initializes BrowserSync
- `gulp assetManifest` 
- `gulp pageBuilder`
- `gulp componentsGeneral`
- `gulp createAjaxFile`
- `gulp createAjaxScriptFiles`
- `gulp docs`
- `gulp build` Builds the whole site
- `gulp buildDev` Builds ONLY the dev folder
- `gulp watch`
- `gulp clean`
- `gulp create`
- `gulp report`
- `gulp fonts`
- `gulp images`
- `gulp general`
- `gulp svg`
- `gulp styles`
- `gulp devStyles`
- `gulp stylesLint`
- `gulp stylesFix`
- `gulp scripts`
- `gulp devScripts`
- `gulp pot`
- `gulp php`
- `gulp wpStyle`
- `gulp componentsStyles`
- `gulp componentsStylesLint`
- `gulp componentsStylesFix`
- `gulp componentsScripts`
- `gulp fix`
- `gulp initVariables` Intisialises the variables files
- `gulp watchOnly` Runs BrowserSync without rebuilding site

## Troubleshooting
### Php clashes with tgmpa
Check [https://github.com/dotherightthing/wpdtrt-plugin-boilerplate/issues/136]


