/*###################### Booklinker

#-- Popup with direct links to online records, queries with ISBN
#-- Catalogs and databases :
	* Opac Horizon SCD Lille 3 : http://hip.scd.univ-lille3.fr/
	* Sudoc : http://www.sudoc.abes.fr
	* OpenLibrary : http://openlibrary.org
	* LibraryThing : http://librarything.com

#-- Details : css class ('booklinker', 'isbn', 'issn') on a link tag + ISBN in 'href' attribute
#-- Notes : technique inspired form the display part of Booklinker WP plugin [http://wordpress.org/extend/plugins/booklinker]. Original script rewritten in jQuery and simplified.
#-- Author : Régis Robineau
*/

jQuery(document).ready(function($) {
	
	/*----------- ISBN */
	$(".entry-content a[class='booklinker'], .entry-content a[class='isbn']").each(function(){

		var isbn = $(this).attr("href"); // ISBN tel que saisi dans le href
		var isbn_clean = $(this).attr("href").replace(/\-+/g,''); // ISBN nettoye (suppression tirets)
		var blank = "onclick='window.open(this.href); return false;'"; // Cible des liens

		function writebookLinkerDiv(){
			
			// On inclut la DIV bookLinkerDiv dans bookLinkerCollection
			$("#bookLinkerCollection").append("<div id='book*"+isbn+"' class='bookLinkerDiv linkerDiv'><p><a href='javascript:;' class='fermer'>Fermer</a></p><ul class='bookLinkerList'></ul><p id='txt'>Consulter la notice d&eacute;taill&eacute;e du livre.</p></div>");
			
			// On crée les items et les liens, on les inclut dans bookLinkerList
			var HipLille3Item = $("<li><a id='lille3' href='http://hip.scd.univ-lille3.fr/ipac20/ipac.jsp?menu=search&aspect=subtab14&npp=10&ipp=20&spp=20&profile=webre&ri=&index=.IS&term="+isbn+"' title='Trouver le livre dans les biblioth&egrave;ques de Lille 3' "+blank+"></a></li>").appendTo(".bookLinkerList");
			var SudocItem = $("<li><a id='sudoc' href='http://www.sudoc.abes.fr/DB=2.1/SET=3/TTL=1/CMD?ACT=SRCHA&IKT=7&SRT=RLV&TRM="+isbn_clean+"' title='Trouver le livre dans le Sudoc (Syst&egrave;me universitaire de documentation)' "+blank+"></a></li>").appendTo(".bookLinkerList");
			var WorldCatItem = $("<li><a id='worldcat' href='http://worldcat.org/isbn/"+isbn_clean+"' title='Trouver le livre dans Worldcat' "+blank+"></a></li>").appendTo(".bookLinkerList");
			var OpenLibraryItem = $("<li><a id='openlibrary' href='http://openlibrary.org/search?q="+isbn_clean+"' title='Trouver le livre dans OpenLibrary' "+blank+"></a></li>").appendTo(".bookLinkerList");
			var LibraryThingItem = $("<li><a id='librarything' href='http://librarything.com/isbn/"+isbn_clean+"' title='Trouver le livre dans LibraryThing' "+blank+"></a></li>").appendTo(".bookLinkerList");

			// On ferme et on supprime bookLinkerDiv et overlay au clic sur bouton Fermer
			$(".bookLinkerDiv").find("a.fermer").click(function(){
				$(".bookLinkerDiv").fadeOut("normal", function(){
					$(".bookLinkerDiv").parent().fadeOut();
					$(".bookLinkerDiv").remove();
				});
				
				$("#overlay").fadeOut("fast", function(){
					$(this).remove();
				});
			});
			
			// On ferme et on supprime bookLinkerDiv et overlay au clic sur l'overlay
			$("#overlay").click(function(){
				$(this).fadeOut("fast", function(){
					$(".bookLinkerDiv").parent().fadeOut();
					$(".bookLinkerDiv").remove();
					$(this).remove();
				});
			});
		}
		
		$(this).click(function(event){
			
			event.preventDefault();
			var left = parseInt(($(window).width()/2) - ($("#bookLinkerCollection").width()/2));
			var top = parseInt(($(window).height()/2) - ($("#bookLinkerCollection").height()/2));
			top += parseInt($(window).scrollTop());
			
			$("body").append("<div id='overlay' class='overlayBG'></div>");
			
			$("#bookLinkerCollection").css({"left":left+"px","top":top+"px"});
			$("#bookLinkerCollection").fadeIn("normal",function(){
				writebookLinkerDiv();
			});	
			
		});
	});
	
	/*---------- ISSN */
	$(".entry-content a[class='issn']").each(function(){

		var issn = $(this).attr("href"); // ISBN tel que saisi dans le href
		var issn_clean = $(this).attr("href").replace(/\-+/g,''); // ISBN nettoye (suppression tirets)
		var blank = "onclick='window.open(this.href); return false;'"; // Cible des liens
		var conteneur = "#perioLinkerCollection";
		var subconteneur = ".perioLinkerDiv";
		var subconteneurClass = "perioLinkerDiv";
		
		function writebookLinkerDiv(){
			
			// On inclut la DIV bookLinkerDiv dans bookLinkerCollection
			$(conteneur).append("<div id='book*"+issn+"' class='"+subconteneurClass+" linkerDiv'><p><a href='javascript:;' class='fermer'>Fermer</a></p><ul class='bookLinkerList'></ul><p id='txt'>Consulter la notice d&eacute;taill&eacute;e du p&eacute;riodique.</p></div>");
			
			// On crée les items et les liens, on les inclut dans bookLinkerList
			var HipLille3Item = $("<li><a id='lille3' href='http://hip.scd.univ-lille3.fr/ipac20/ipac.jsp?menu=search&aspect=subtab14&npp=10&ipp=20&spp=20&profile=webre&ri=&index=.IS&term="+issn+"' title='Trouver le p&eacute;riodique dans les biblioth&egrave;ques de Lille 3' "+blank+"></a></li>").appendTo(".bookLinkerList");
			var SudocItem = $("<li><a id='sudoc' href='http://www.sudoc.abes.fr/DB=2.1/SET=3/TTL=1/CMD?ACT=SRCHA&IKT=8&SRT=RLV&TRM="+issn_clean+"' title='Trouver le p&eacute;riodique dans le Sudoc (Syst&egrave;me universitaire de documentation)' "+blank+"></a></li>").appendTo(".bookLinkerList");
			var WorldCatItem = $("<li><a id='worldcat' href='http://worldcat.org/search?q=n2:"+issn_clean+"' title='Trouver le p&eacute;riodique dans Worldcat' "+blank+"></a></li>").appendTo(".bookLinkerList");

			// On ferme et on supprime bookLinkerDiv et overlay au clic sur bouton Fermer
			$(subconteneur).find("a.fermer").click(function(){
				$(subconteneur).fadeOut("normal", function(){
					$(subconteneur).parent().fadeOut();
					$(subconteneur).remove();
				});
				
				$("#overlay").fadeOut("fast", function(){
					$(this).remove();
				});
			});
			
			// On ferme et on supprime bookLinkerDiv et overlay au clic sur l'overlay
			$("#overlay").click(function(){
				$(this).fadeOut("fast", function(){
					$(subconteneur).parent().fadeOut();
					$(subconteneur).remove();
					$(this).remove();
				});
			});
		}
		
		$(this).click(function(event){
			
			event.preventDefault();
			var left = parseInt(($(window).width()/2) - ($(conteneur).width()/2));
			var top = parseInt(($(window).height()/2) - ($(conteneur).height()/2));
			top += parseInt($(window).scrollTop());
			
			$("body").append("<div id='overlay' class='overlayBG'></div>");
			
			$(conteneur).css({"left":left+"px","top":top+"px"});
			$(conteneur).fadeIn("normal",function(){
				writebookLinkerDiv();
			});	
			
		});
	});
	
});

/*###################### Citations 
#-- Parse citations in blog post and generate list after title 'titreCitations'
*/
/* Code deplace dans footer.php */
/*
jQuery(document).ready(function($){
	var ul = document.createElement("ul");
	$(ul).addClass("listCitations").insertAfter(".titreCitations");
	$("a[class='citation']").each(function(){
		var title = $(this).attr("title");
		var href = $(this).attr("href");
		var rel = $(this).attr("rel");
		var li = document.createElement("li");
		$(li).appendTo(".listCitations").text(title);
		$(li).wrapInner("<a href='"+href+"' rel='"+rel+"' />");
	});
});*/

/*###################### Cite post */

/*
jQuery(document).ready(function($){
	$(".cite-post").hide();
	$(".cite a").click(function(e){
		e.preventDefault();
		$(this).parent().next().slideToggle('fast');
	});
});*/

/*###################### ScrollTop */

jQuery(document).ready(function($){
	$('<div id="scrollTop"><a href="#wrap" title="Retour en haut de page">Haut &uarr;</a></div>').appendTo('body').css({opacity: 0});
	$(window).scroll(function(){
		
		// Position du scroll
		var scrollTop = $(window).scrollTop();
		$('#scrollTop a').click(function(){
			$('html,body').stop().animate({scrollTop: 0}, 'slow');
		});
 
		// Si la position du scroll atteint la moitie de la taille du document, alors on affiche la div scrollTop.
		var div = $('#scrollTop');
		
		if(scrollTop >= 300){
			if(div.css('opacity') == 0){
				div.stop().animate({opacity: 1}, 500);
			}
		}else{
			// Sinon, on affiche pas la div
			if(div.css('opacity') > 0){
				div.stop().animate({opacity: 0}, 500);	
			} 
		}
	});
	$(window).scroll();
});


/*###################### Placeholder fallback */
$(document).ready(function() {
        if (!Modernizr.input.placeholder)
        {
			$('[placeholder]').each(function(){
				var placeholderText = $(this).attr('placeholder');
				
				$(this).addClass('placeholder');
				
				$(this).attr('value', placeholderText);
				
				$(this).focus(function() {
                        if( ($(this).val() == placeholderText) )
                        {
                                $(this).attr('value','');
                                $(this).removeClass('placeholder');
                        }
                });
                
                $(this).blur(function() {
                        if ( ($(this).val() == placeholderText) || (($(this).val() == '')) )
                        {
                                $(this).addClass('placeholder');
                                $(this).attr('value',placeholderText);
                        }
                });
			});
        }
});

/*######################  l10n.js function (native WP) : deregistered in functions.php */
function convertEntities(b){var d,a;d=function(c){if(/&[^;]+;/.test(c)){var f=document.createElement("div");f.innerHTML=c;return !f.firstChild?c:f.firstChild.nodeValue}return c};if(typeof b==="string"){return d(b)}else{if(typeof b==="object"){for(a in b){if(typeof b[a]==="string"){b[a]=d(b[a])}}}}return b};
