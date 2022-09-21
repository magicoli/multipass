/**
 * Referenc for future use, highlight all bookings from the same prestation on hover.
 *
 * @param  {[type]} classname                              [description]
 * @param  {[type]} colorover                              [description]
 * @param  {String} [colorout="transparent"]               [description]
 * @return {[type]}                          [description]
 */
function hoverByClass(classname,colorover,colorout="transparent"){
	var elms=document.getElementsByClassName(classname);
	for(var i=0;i<elms.length;i++){
		elms[i].onmouseover = function(){
			for(var k=0;k<elms.length;k++){
				elms[k].style.backgroundColor=colorover;
			}
		};
		elms[i].onmouseout = function(){
			for(var k=0;k<elms.length;k++){
				elms[k].style.backgroundColor=colorout;
			}
		};
	}
}
hoverByClass("un","yellow");
hoverByClass("un2","pink");

// <div class="book">
//   <div class="page left">
//     <p class="un">Karen…</p><p class="un2">Karen2…</p>
//   </div>
//   <div class="page right">
//     <p class="un">Karen ne se retourne pas. Mme Tilford reste là, apparemment confuse et abattue.</p>
//     <p class="un2">Karen2 ne se retourne pas. Mme Tilford2 reste là, apparemment confuse et abattue.</p>
//   </div>
// </div>
//
