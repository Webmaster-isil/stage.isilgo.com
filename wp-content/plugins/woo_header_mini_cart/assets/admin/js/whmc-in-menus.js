(function($){'use strict';whmcMenuAdded();function whmcMenuAdded(){$('#whmc_submit_menu').on('click',function(e){wpNavMenu.registerChange();var description=$('#whmc-menu-html').val();var menuItems={};var processMethod=wpNavMenu.addMenuItemToBottom;var whmcDiv=$('.whmc-menu-div');whmcDiv.find('.spinner').addClass('is-active');var whmcDivMenu=/menu-item\[([^\]]*)/;var wmcMatch=whmcDiv.find('.menu-item-db-id');var listItemDBIDMatch=whmcDivMenu.exec(wmcMatch.attr('name')),listItemDBID='undefined'==typeof listItemDBIDMatch[1]?0:parseInt(listItemDBIDMatch[1],10);menuItems[listItemDBID]=whmcDiv.getItemData('add-menu-item',listItemDBID);menuItems[listItemDBID]['menu-item-description']=description;if(menuItems[listItemDBID]['menu-item-title']===''){menuItems[listItemDBID]['menu-item-title']='Woo Header Mini Cart'}
var nonce=$('#whmc-menu-nonce').val();var params={'action':'whmc_object_description_hack','description-nonce':nonce,'menu-item':menuItems[listItemDBID]};jQuery.post(ajaxurl,params,function(objectId){$('#whmc-menu-div .menu-item-object-id').val(objectId);wpNavMenu.addItemToMenu(menuItems,processMethod,function(){whmcDiv.find('.spinner').removeClass('is-active');$('#whmc-menu-title').val('').blur();$('#whmc-menu-html').val('')})})})}})(jQuery)