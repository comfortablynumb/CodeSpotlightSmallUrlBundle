CodeSpotlightSmallUrlBundle
===========================

A bundle which provides a complete site with functionalities similar to TinyURL.

Dependencies
------------

You will need to install the bundle CodeSpotlightApplicationToolsBundle first.

Clone the bundle: ::

    git clone git://github.com/comfortablynumb/CodeSpotlightApplicationToolsBundle.git vendor/bundles/CodeSpotlight/Bundle/ApplicationToolsBundle

Then modify your autoload.php: ::

    // autoload.php
    $loader->registerNamespaces(array(
        // Rest of vendors..
        
        'CodeSpotlight' => __DIR__.'/../vendor/bundles'
    ));

Register the bundle in your AppKernel.php: ::

    // AppKernel.php
    public function registerBundles()
    {
        $bundles = array(
            // Rest of bundles..
            new CodeSpotlight\Bundle\ApplicationToolsBundle\CodeSpotlightApplicationToolsBundle()
        );
    }

Now you're done with the dependencies.

Installation
------------

Now that you have all the dependencies in place, you need to clone the bundle:

    git clone git://github.com/comfortablynumb/CodeSpotlightSmallUrlBundle.git vendor/bundles/CodeSpotlight/Bundle/SmallUrlBundle

Register the bundle in your AppKernel.php: ::

    // AppKernel.php
    public function registerBundles()
    {
        $bundles = array(
            // Rest of bundles..
            new CodeSpotlight\Bundle\SmallUrlBundle\CodeSpotlightSmallUrlBundle()
        );
    }

And import the routing file: ::

    // routing.yml
    //
    // More routes..
    CodeSpotlightSmallUrlBundle:
    resource: "@CodeSpotlightSmallUrlBundle/Resources/config/routing.yml"
    prefix:   /

And that's it. Access to the root of your web directory with your browser and you should be able to look at the homepage of the SmallUrl site.


What can I do with this site?
-----------------------------

Besides being able to create a small URL from a normal one, the site is ready to be customized. It has the main form, an about us section and a contact section.

But the best thing about this is that this site can be extended to create sites that provide similar functionalities. For instance, if you want to create a site to share photos, you only need to customize the form, add the missing functionalities to the actual service, extend the original Url entity, modify the template and you're ready to go! other sites with similar functionalities to pastebin should be easy to create too.

TODO
----

* Make a MappedSuperclass to allow easy extending of the entity for sites with similar functionalities (photo sharing, etc.).
* Add the contact form
* Add "Last urls added by you"

Thanks to
---------

Design Modo for some of the assets used in this site: http://designmodo.com/free-psd-web-ui-elements-kit-set/
