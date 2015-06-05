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
127.0.0.1    magento-dev
```

Point your browser to the Magento store
```
magento-dev/magento
```

Configure the Magento instance

1. In 'Database Connection'
  1. Database host should be ```mysql```
  1. Database user should be ```magento```
  1. Database password should be ```magento```
2. In 'Web access options'
  1. Set Base URL to 'https://magento-dev/'
  1. Check "Skip Base URL Validation Before Next Step"

Otherwise select defaults and/or fill out as you like.  More help can be found at http://www.magentocommerce.com/knowledge-base/entry/magento-installation-cheat-sheet.

Make sure you can acccess the front end and back end of the magento instance using the links at the end of the install process.

## Integrating
Follow the guide [here] (https://support.shippingeasy.com/hc/en-us/articles/203085049-How-to-Integrate-your-Magento-store-with-ShippingEasy-step-by-step-guide-with-pictures-)
