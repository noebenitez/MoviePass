(function(window, undefined) {
  var dictionary = {
    "e7fd16be-da13-40a4-9e8d-3dd42ac51625": "home_cliente",
    "b5340289-70dd-45f0-86a1-9b8e60528344": "Agregar_Funcion",
    "d12245cc-1680-458d-89dd-4f0d7fb22724": "login",
    "88afef1c-2130-455a-a72b-b10950ca6791": "home_admin",
    "d0c1e2ae-a01f-4e12-915a-bff9bca54ca0": "Agregar_cine",
    "12887915-e264-42c2-8de7-db0d7bbc60e5": "Agregar_pelicula",
    "f39803f7-df02-4169-93eb-7547fb8c961a": "Template 1",
    "bb8abf58-f55e-472d-af05-a7d1bb0cc014": "default"
  };

  var uriRE = /^(\/#)?(screens|templates|masters|scenarios)\/(.*)(\.html)?/;
  window.lookUpURL = function(fragment) {
    var matches = uriRE.exec(fragment || "") || [],
        folder = matches[2] || "",
        canvas = matches[3] || "",
        name, url;
    if(dictionary.hasOwnProperty(canvas)) { /* search by name */
      url = folder + "/" + canvas;
    }
    return url;
  };

  window.lookUpName = function(fragment) {
    var matches = uriRE.exec(fragment || "") || [],
        folder = matches[2] || "",
        canvas = matches[3] || "",
        name, canvasName;
    if(dictionary.hasOwnProperty(canvas)) { /* search by name */
      canvasName = dictionary[canvas];
    }
    return canvasName;
  };
})(window);