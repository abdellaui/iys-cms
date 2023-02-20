CodeMirror.defineMode("parameterMode", function() {
    return {
        token: function(stream,state) {
          var ch = stream.next();
          if (ch == "{") {
              var ok = true;
              if (stream.eat("{")) {
                ok = stream.eatWhile(/[\w\.\-:]/) && stream.eat(";");
                if(!ok && stream.eat("}")){
                  ok = stream.eatWhile(/[\w\.\-:]/) && !stream.eat("}");
                  if(!ok && stream.eat("}")){
                    ok = false;
                  }
                }
              } else {
                 ok = false;
              }
              return ok ? "error" : "parameterHalter";
            } 
            else {
              stream.eatWhile(/[^&<\{\}]/);
              return null;
            }
        }
    };
    
});