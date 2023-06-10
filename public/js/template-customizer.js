function customizer() {
  $("#template-customizer").addClass("template-customizer-open");
}

function close() {
  $("#template-customizer").removeClass("template-customizer-open");
}

document.addEventListener("DOMContentLoaded", function () {
  // Obtener el checkbox por su id
  var darkModeCheckbox = document.getElementById("dark-mode-button");

  // Función para mostrar el contenido con una transición de fundido
  function showContent() {
    document.documentElement.classList.add("visible");
  }

  // Función para cambiar los estilos y guardar la configuración en una cookie
  function setDarkMode() {
    // Modificar las etiquetas <link> de los estilos CSS
    var coreCssLink = document.querySelector(
      "link.template-customizer-core-css"
    );
    coreCssLink.href = "/css/app/vendor/css/core-dark.css";

    var themeCssLink = document.querySelector(
      "link.template-customizer-theme-css"
    );
    themeCssLink.href = "/css/app/vendor/css/theme-default-dark.css";

    // Cambiar la clase en el HTML
    document.documentElement.classList.remove("light-style");
    document.documentElement.classList.add("dark-style");

    // Guardar la configuración en una cookie
    document.cookie =
      "darkMode=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";

    // Mostrar el contenido y eliminar la clase "hidden"
    document.documentElement.classList.remove("hidden");
  }

  // Función para cambiar los estilos y eliminar la configuración de la cookie
  function setLightMode() {
    // Modificar las etiquetas <link> de los estilos CSS
    var coreCssLink = document.querySelector(
      "link.template-customizer-core-css"
    );
    coreCssLink.href = "/css/app/vendor/css/core.css";

    var themeCssLink = document.querySelector(
      "link.template-customizer-theme-css"
    );
    themeCssLink.href = "/css/app/vendor/css/theme-default.css";

    // Cambiar la clase en el HTML
    document.documentElement.classList.remove("dark-style");
    document.documentElement.classList.add("light-style");

    // Eliminar la configuración de la cookie
    document.cookie =
      "darkMode=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";

    // Mostrar el contenido y eliminar la clase "hidden"
    document.documentElement.classList.remove("hidden");
  }

  // Función para verificar la configuración almacenada en la cookie
  function checkDarkMode() {
    var darkModeCookie = document.cookie
      .split(";")
      .map((cookie) => cookie.trim())
      .find((cookie) => cookie.startsWith("darkMode="));

    if (darkModeCookie) {
      var darkModeValue = darkModeCookie.split("=")[1];
      if (darkModeValue === "true") {
        // Marcar el checkbox como activado
        darkModeCheckbox.checked = true;
        setDarkMode();
        showContent();
      }
    } else {
      // Mostrar el contenido y eliminar la clase "hidden"
      document.documentElement.classList.remove("hidden");
      showContent();
    }
  }

  // Manejar el evento de cambio del checkbox
  darkModeCheckbox.addEventListener("change", function () {
    if (this.checked) {
      setDarkMode();
    } else {
      setLightMode();
    }
  });

  // Verificar la configuración al cargar la página
  checkDarkMode();
});
