<?php
//
//// Dummy Content
//RouteFactory::route('GET', '/images/dummy/image[.{type: png|jpg|jpeg}]','imageController@getDummyImage');
//RouteFactory::route('GET', '/images/dummy/image/{size}[.{type: png|jpg|jpeg}]','imageController@getDummyImage');
//RouteFactory::route('GET', '/images/dummy/image/{size}/{background}[.{type: png|jpg|jpeg}]','imageController@getDummyImage');
//RouteFactory::route('GET', '/images/dummy/image/{size}/{background}/{color}[.{type: png|jpg|jpeg}]','imageController@getDummyImage');
//RouteFactory::route('GET', '/images/clearCache[/{clear: all}]', 'imageController@clearTmpFolder');
//RouteFactory::route('GET', '/images/{hsize}/{wsize}/{file:.+}', 'imageController@getImage');
//
//
//RouteFactory::route('GET', '/demo/photos', 'mainController@get_eikones');
//
//
////      Admin
//RouteFactory::route('GET', '/diaxeiristiko', 'mainController@get_admin');
//
////      GIT
//RouteFactory::route('POST', '/gitDeploy', 'gitController@deploy');
//
//
//// Sitemap
//RouteFactory::route('GET', '/sitemapIndex.xml','SitemapController@getSitemaps');
//RouteFactory::route('GET', '/sitemapIndex/{list}.xml','SitemapController@getSitemap');




//      Homepage

RouteFactory::route('GET', '/','homeController@index');

//Sitemap

RouteFactory::route('GET', '/sitemap.xml','homeController@getSiteMap');


//PAGES
//RouteFactory::route('GET', '/photo_gallery', 'pagesController@gallery');
//RouteFactory::route('GET', '/page_content1', 'pagesController@content1');
//RouteFactory::route('GET', '/page_content2', 'pagesController@content2');
//RouteFactory::route('GET', '/page_list1', 'pagesController@list1');
//RouteFactory::route('GET', '/page_list2', 'pagesController@list2');

//News
RouteFactory::route('GET', '/news/{caption}[/page{pagenum}]','newsController@getNewsList');
RouteFactory::route('GET', '/{langs}/news/{caption}[/page{pagenum}]','newsController@getNewsList');

RouteFactory::route('GET', '/neo/{id}/{caption}','newsController@getNeo');
RouteFactory::route('GET', '/{langs}/neo/{id}/{caption}','newsController@getNeo');

RouteFactory::route('GET', '/preview/neo/{id}/{caption}','newsController@getNeoPreview');
RouteFactory::route('GET', '/{langs}/preview/neo/{id}/{caption}','newsController@getNeoPreview');


//      contact
RouteFactory::route('GET', '/contact','contactController@getContact');
RouteFactory::route('GET', '/{langs}/contact','contactController@getContact');

RouteFactory::route('POST', '/contact/send','contactController@sendContact');

//Gallery
RouteFactory::route('GET', '/gallery', 'contentController@getGallery');
RouteFactory::route('GET', '/{langs}/gallery', 'contentController@getGallery');


RouteFactory::route('POST', '/gallery/load_more', 'contentController@loadMoreFromGallery');

//Content
RouteFactory::route('GET', '/{caption}','contentController@getContentPost');
RouteFactory::route('GET', '/{langs}/{caption}','contentController@getContentPost');

RouteFactory::route('GET', '/preview/{caption}','contentController@getContentPostPreview');
RouteFactory::route('GET', '/{langs}/preview/{caption}','contentController@getContentPostPreview');

//      UserLinks
//RouteFactory::route('GET', '/register','profileController@getRegister');

//RouteFactory::route('GET', '/login','profileController@getLogin');

//RouteFactory::route('GET', '/profile','profileController@getProfile','user');


RouteFactory::route('GET', '/demo/{test}','contentController@getDemo');






/**
 *
 *  POST LINKS
 *
 */

//RouteFactory::route('POST', '/contact/send','contactController@sendContact');

//RouteFactory::route('POST', '/send/forma/endiaferontos','homeController@saveEkdilosiEndiaferontos');

//RouteFactory::route('POST', '/newsletter/send','mainController@saveNewsletter');

//RouteFactory::route('POST', '/get/content','contentController@getContentPost');


//RouteFactory::route('POST', '/get/link','configController@getLinkMake');
//RouteFactory::route('POST', '/en/get/link','configController@getLinkMake');
//
//RouteFactory::route('POST', '/get/translate','configController@getTranslate');
//RouteFactory::route('POST', '/en/get/translate','configController@getTranslate');
