function Interpolate(start, end, steps, count) {
    var s = start,
        e = end,
        final = s + (((e - s) / steps) * count);
    return Math.floor(final);
}

function Color(_r, _g, _b) {
    var r, g, b;
    var setColors = function(_r, _g, _b) {
        r = _r;
        g = _g;
        b = _b;
    };

    setColors(_r, _g, _b);
    this.getColors = function() {
        var colors = {
            r: r,
            g: g,
            b: b
        };
        return colors;
    };
}

    function scaleColor(percent) {

        val   = parseInt(percent),
        red   = new Color(255, 0, 0),
        green = new Color(0, 255, 0),
        end   = green,
        start = red;

       

        var startColors = start.getColors(),
            endColors = end.getColors();
        var r = Interpolate(startColors.r, endColors.r, 50, val);
        var g = Interpolate(startColors.g, endColors.g, 50, val);
        var b = Interpolate(startColors.b, endColors.b, 50, val);

        return "rgb(" + r + "," + g + "," + b + ")";

    }

    function createGraph(data, note) {


      var data    = jQuery.parseJSON(data);
      var height  = 50;
      var width   = 100;

      var svg= jQuery('<svg/>', {
        height: height,
        width: width
      });
      
      var length  = 6
      var o       = data.length - length;
      var u       = 0;
      var largeur = 10;
      var span    = 1;
      var maxNote = 20;
      
      for (var i = o ; i <= data.length -1; i++) {
        
        u++;
        var d       = data[i];

        if(d != undefined) {
          if(d > maxNote)
            d = maxNote;

          var cuHei   = (d * height) / maxNote;

          if(isNaN(cuHei))
            cuHei = height;

          var x       = u * (largeur + span);
          var y       = (height - cuHei);

          if(d == 0)
            y = height - 1;

          var rect    = $('<rect>')
                        .attr('x', x)
                        .attr('y', y)
                        .attr('width', largeur)
                        .attr('height', height)
                        .css('fill', scaleColor(d * 100 / maxNote));


          svg.append(rect);
        }

      };


      return $('<div>').html(svg);
    }

    window.onload = function () {
      $('.raphy').each(function() {
          
        var data  = $(this).attr('data-value');
        var graph = createGraph(data, 50);
        //console.log(graph.html());

        $(this).append(graph.html());


      });
    };