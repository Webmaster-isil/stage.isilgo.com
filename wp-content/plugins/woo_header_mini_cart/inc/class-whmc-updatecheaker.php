<?php

if( ! class_exists( 'WhmcUpdateChecker' ) ) {

    class WhmcUpdateChecker{

        public $plugin_slug;
        public $version;
        public $cache_key;
        public $cache_allowed;

        public function __construct() {

            $this->plugin_slug = WHMC_BASENAME_DIR;


            $this->version = WHMC_VERSION;
            $this->cache_key = 'qrc_iplafs';
            $this->cache_allowed = false;

			$file   = WHMC_BASENAMEFILES;
			$folder = WHMC_BASENAMEFOLDER;
			$hook = "in_plugin_update_message-{$folder}/{$file}";

            add_filter( 'plugins_api', array( $this, 'info' ), 20, 3 );
            add_filter( 'site_transient_update_plugins', array( $this, 'update' ) );
            add_action( 'upgrader_process_complete', array( $this, 'purge' ), 10, 2 );

            add_action( $hook, array( $this,'your_update_message_cb'), 10, 2 );

        }
		function your_update_message_cb( $plugin_data, $r )
		{
		    echo '<em> Please visit <a href="https://sharabindu.com/my-account/downloads/"> My account page</a> and download the updated version and then install it </em>';


		}
        public function request(){

            $remote = get_transient( $this->cache_key );

            if( false === $remote || !$this->cache_allowed ) {

                $remote = wp_remote_get(
                    'https://woominicart.sharabindu.com/wp-content/uploads/plugin.json',
                    array(
                       'timeout'     => 0,
                        'headers' => array(
                            'Accept' => 'application/json'
                        )
                    )
                );

                if(
                    is_wp_error( $remote )
                    || 200 !== wp_remote_retrieve_response_code( $remote )
                    || empty( wp_remote_retrieve_body( $remote ) )
                ) {
                    return false;
                }

                set_transient( $this->cache_key, $remote, DAY_IN_SECONDS );

            }

            $remote = json_decode( wp_remote_retrieve_body( $remote ) );

            return $remote;

        }


        function info( $res, $action, $args ) {

            // do nothing if you're not getting plugin information right now
            if( 'plugin_information' !== $action ) {
                return $res;
            }

            // do nothing if it is not our plugin
            if( $this->plugin_slug !== $args->slug ) {
                return $res;
            }

            $remote = $this->request();

            if( ! $remote ) {
                return $res;
            }
            $res = new stdClass();
            $res->name = $remote->name;
            $res->slug = $remote->slug;
            $res->version = $remote->version;
            $res->tested = $remote->tested;
            $res->requires = $remote->requires;
            $res->author = $remote->author;
            $res->author_profile = $remote->author_profile;
            $res->trunk = $remote->download_url;
            $res->requires_php = $remote->requires_php;
            $res->last_updated = $remote->last_updated;
            $res->active_installs = $remote->isntallssd;
            $res->homepage = $remote->homepages; 

    
            $res->sections = array(
                'description' => $remote->sections->description,
                'installation' => $remote->sections->installation,
                'changelog' => $remote->sections->changelog
            );

            if( ! empty( $remote->banners ) ) {
                $res->banners = array(
                    'low' => $remote->banners->low,
                    'high' => $remote->banners->high
                );
            }

            return $res;

        }

        public function update( $transient ) {

            if ( empty($transient->checked ) ) {
                return $transient;
            }

            $remote = $this->request();

            if(
                $remote
                && version_compare( $this->version, $remote->version, '<' )
                && version_compare( $remote->requires, get_bloginfo( 'version' ), '<' )
                && version_compare( $remote->requires_php, PHP_VERSION, '<' )
            ) {
                $res = new stdClass();
                $res->slug = $this->plugin_slug;
                $res->plugin = WHMC_BASENAME;
                $res->new_version = $remote->version;
                $transient->response[ $res->plugin ] = $res;

        }

            return $transient;

        }

        public function purge(){

            if (
                $this->cache_allowed
                && 'update' === $options['action']
                && 'plugin' === $options[ 'type' ]
            ) {
                // just clean the cache when new plugin version is installed
                delete_transient( $this->cache_key );
            }

        }


    }

    new WhmcUpdateChecker();

}