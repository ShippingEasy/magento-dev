## Magento-Dev

This is nginx fronting Magento talking to MySQL all in a docker-compose cluster.
nginx is configured to forward all requests from 80 and 443 to magento on port 8080,
so those ports should be available on your docker host.  443 will be served over
ssl with a self-signed certificate.  You can modify the nginx configuration in
nginx.conf as needed to emulate a customer's self-hosted setup.

## Prerequisites
* docker
* docker-compose

## Setting Up
In terminal 1:
```
docker-compose up
```

In terminal 2 (after magento & mysql start):
```
./setup
```

Add the following to your /etc/hosts file
```
127.0.0.1    magento.dev
```

Point your browser to the Magento store
```
http://magento.dev/admin
```

Login with the `MAGENTO_ADMIN_USERNAME` & `MAGENTO_ADMIN_PASSWORD` values in the `env` file

## Alternative manual setup procedure

The store can be setup manually by removing the `install-magento` line in the `setup` file. In that case, pointing your browser to the Magento store at `http://magento.dev/admin` will start the setup process.

To configure the Magento instance:

1. In 'Database Connection'
  1. Database host should be ```mysql```
  1. Database user should be ```magento```
  1. Database password should be ```magento```
2. In 'Web access options'
  1. Enter a Base URL of ```http://magento.dev```.
  1. Check "Skip Base URL Validation Before Next Step"

Otherwise select defaults and/or fill out as you like.  More help can be found at http://www.magentocommerce.com/knowledge-base/entry/magento-installation-cheat-sheet.

Make sure you can acccess the front end and back end of the magento instance using the links at the end of the install process.

## Integrating
Follow the guide [here] (https://support.shippingeasy.com/hc/en-us/articles/203085049-How-to-Integrate-your-Magento-store-with-ShippingEasy-step-by-step-guide-with-pictures-)

## Troubleshooting
Have seen a few issues related to redirects.  If so, look at terminal output to see the URL being accessed, then try to curl against it with the -v option to see what is going on.

## Generating Sample Orders
To generate more orders:

1. Log into the magento docker container w/ `docker exec -it magento-dev_magento_1 /bin/bash`
2. Run the generateSampleOrders.php script w/ `php ./generateSampleOrders.php`

That script should generate 100 new, recently placed orders to work with.