Array.prototype.slice.call(document.getElementsByTagName('*')).forEach(row => { 
  var el = window.getComputedStyle(row); 
  var parts = el.getPropertyValue('color').match(/(\d+)/g);
  var avgfg = parts.reduce((a,b) => parseInt(b,10) + a, 0) / 3;
  if(avgfg < 160) {
    row.setAttribute('style', 'color:#000 !important;');
  } 
  if(avgfg > 200) {
    row.setAttribute('style', 'color:#fff !important;');
  }
  //console.log(avgfg, avgbg, parts, el.getPropertyValue('background'));
})
