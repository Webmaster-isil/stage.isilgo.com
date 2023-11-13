jQuery(document.body).on("added_to_cart", function ($) {
  jQuery.ajax({
    type: "POST",
    url: wc_add_to_cart_params.ajax_url,
    data: {
      action: "revisaCarritoMembresia",
    },

    success: function (response) {
      if (response == 1) {
        jQuery(".pop_up_alerta_bg").show();
      }
    },
  });
});

window.addEventListener("load", function () {});

document.addEventListener("DOMContentLoaded", function (event) {});

jQuery(document).ready(function ($) {
  $(".esconde_desktop_menu_burger > a").click(function (e) {
    e.preventDefault();
    $(this).siblings(".sub-menu").show();
    console.log("demo");
  });

  $(".volver_menu_escondido a").click(function (e) {
    e.preventDefault();
    console.log("demo2");
    $(this).closest("ul").hide();
  });

  $(".cortina").fadeOut();
  $(".contenedor_regalo").submit(function (e) {
    $(".loaderCustom").css("display", "block");
    $(".regalar_ok").prop("disabled", true);
  });

  var wpcf7Elm = document.querySelector(".contenedor_regalo");
  if (wpcf7Elm) {
    wpcf7Elm.addEventListener(
      "wpcf7submit",
      function (event) {
        $(".regalar_ok").prop("disabled", false);
        $(".loaderCustom").hide();
      },
      false
    );
  }

  function myFunction(x) {
    if (x.matches) {
      $("#menu-hamburguesa").append(
        '<li class="mobile_adicionales"><div class="login_especial"><a href="#">Iniciar sesión</a><a class="register_burger" href="#">REGISTRARSE</a><a href="#" class="first_back">Volver</a></div></li>'
      );
      $(".first_back").click(function (e) {
        e.preventDefault();
        ;
        $("#menu-hamburguesa").fadeOut();
      });
    } else {
      $(".mobile_adicionales").remove();
    }
  }

  var x = window.matchMedia("(max-width: 768px)");
  myFunction(x); // Call listener function at run time
  x.addListener(myFunction); // Attach listener function on state changes

  $("#mostrarFiltros").click(function (e) {
    e.preventDefault();
    $(".contenedor-filtros").show();
  });

  $(".cerrar_filtros").click(function (e) {
    e.preventDefault();
    $(".contenedor-filtros").fadeOut();
  });
  $(".mas_comentarios").click(function (e) {
    e.preventDefault();
    $(".commentlist li").show();
  });
  $(".whmc-bottom-part").prepend('<div class="contenido"></div>');

  $.ajax({
    type: "POST",
    url: "/wp-admin/admin-ajax.php",
    data: {
      action: "recientesVistos",
    },
    success: function (response) {
      $(".contenido").html(response);
    },
  });

  $(".descargar_certificado").click(function (e) {
    var codigooperaciongrupo = $(this).data("codigooperaciongrupo");
    $(".loaderCustom").show();
    $(this).addClass("btn_desactivado");

    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "descargarPDF",
        codigooperaciongrupo: codigooperaciongrupo,
      },
      success: function (response) {
        if (response == 2) {
          alert(
            "Aún no se ha generado su certificado. Vuelva a intentarlo más tarde."
          );
          $(".loaderCustom").hide();
          $(".descargar_certificado").removeClass("btn_desactivado");
        } else {
          window.location.href = response;
          $(".loaderCustom").hide();
          $(".descargar_certificado").removeClass("btn_desactivado");
        }
      },
    });
  });

  $(".cart_menu_li").click(function (e) {
    if ($(".carro_vacio").length == 0) {
      $(".whmc-empty-cart").append("<div class='carro_vacio'></div>");
      $.ajax({
        type: "POST",
        url: "/wp-admin/admin-ajax.php",
        data: {
          action: "recientesVistosCarroVacio",
        },
        success: function (response) {
          $(".woo_hader_cart__empty_message").hide();
          $(".carro_vacio").html(response);
        },
      });
    }
  });

  $(".wmc-sub-currency").append("<p>Cambiar tipo de moneda PEN/USD</p>");
  $("#billing_ruc").attr("maxlength", "11");
  $("#billing_ruc").keypress(function (e) {
    var charCode = e.which ? e.which : event.keyCode;

    if (String.fromCharCode(charCode).match(/[^0-9]/g)) return false;
  });
  // $(".ruc_empresa").attr("maxlength", "11");
  $("#billing_dni").attr("maxlength", "8");
  $("#billing_extranjeria").attr("maxlength", "9");
  $("#billing_pasaporte").attr("maxlength", "12");

  if ($("#billing_dni").val()) {
    $("#billing_dni").addClass("desactivado");
    $("#billing_dni").attr("readonly", true);
  }

  if ($("#billing_extranjeria").val()) {
    $("#billing_extranjeria").addClass("desactivado");
    $("#billing_extranjeria").attr("readonly", true);
  }

  if ($("#billing_pasaporte").val()) {
    $("#billing_pasaporte").addClass("desactivado");
    $("#billing_pasaporte").attr("readonly", true);
  }

  $(".wp-block-tag-cloud").prepend('<a href="/cursos">Todos los cursos</a>');

  $(".recientes").owlCarousel({
    margin: 20,
    dots: true,
    items: 1,
    loop: true,
    nav: false,
    autoHeight: false,
    autoplay: false,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
  });

  $(".relacionados_pdp").owlCarousel({
    margin: 20,
    dots: true,
    items: 3,
    loop: true,
    nav: false,
    autoHeight: false,
    autoplay: false,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: { 0: { items: 1 }, 600: { items: 2 }, 1000: { items: 3 } },
  });

  $(".productosEtiquetas").owlCarousel({
    margin: 20,
    dots: true,
    items: 3,
    loop: true,
    nav: false,
    arrow: true,
    autoHeight: false,
    autoplay: false,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: { 0: { items: 1 }, 600: { items: 2 }, 1000: { items: 4 } },
  });

  $(".productosRecomendados").owlCarousel({
    margin: 20,
    dots: true,
    items: 4,
    loop: true,
    nav: true,
    arrow: true,
    autoHeight: false,
    autoplay: false,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    responsive: { 0: { items: 1 }, 600: { items: 2 }, 1000: { items: 4 } },
  });

  $(".docentes").owlCarousel({
    margin: 20,
    dots: true,
    items: 3,
    loop: true,
    nav: true,
    autoHeight: false,
    autoplay: false,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    navText: ["<", ">"],
    responsive: {
      0: { items: 1, dotsEach: 1 },
      600: { items: 2, dotsEach: 2 },
      1000: { items: 3, dotsEach: 3 },
    },
  });

  $(".especiales_membresias").owlCarousel({
    margin: 20,
    dots: true,
    items: 5,
    loop: true,
    nav: false,
    autoHeight: false,
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    // navText: ["<", ">"],
    responsive: {
      0: { items: 1, dotsEach: 1 },
      600: { items: 2, dotsEach: 2 },
      1000: { items: 4, dotsEach: 4 },
    },
  });

  $(".ver_mas_sesion").click(function (e) {
    e.preventDefault();

    var item = $(this).parent().siblings(".sesion_detalle");
    if ($(this).hasClass("ocultar")) {
      $(this).removeClass("ocultar");
      $(this).text("Ver más");
    } else {
      $(this).addClass("ocultar");
      $(this).text("Ver menos");
    }

    if (item.hasClass("active")) {
      item.hide();
      item.removeClass("active");
    } else {
      item.show();

      item.addClass("active");
    }
  });

  var id = $(".id_membresia").data("id");
  $(".precio_membresia .wpcbn-btn").attr("value", id);
  $(".precio_membresia .wpcbn-btn").attr("data-product_id", id);
  $(".precio_membresia .wpcbn-btn").text("VUÉLVETE PREMIUM");
  $("#select_membresia").click(function (e) {
    $(".precio_normal").hide();
    $(".compraRapidaMembresia").show();
    $(this).parent("li").addClass("claseActiva");
    $("#select_normal").parent("li").removeClass("claseActiva");
  });

  $("#select_normal").click(function (e) {
    $(".compraRapidaMembresia").hide();
    $(".precio_normal").show();
    $(this).parent("li").addClass("claseActiva");
    $("#select_membresia").parent("li").removeClass("claseActiva");
  });

  $(".levanta_popup").click(function (e) {
    e.preventDefault();
    $(".pop_video").fadeIn();
  });

  $(".cerrar_video").click(function (e) {
    e.preventDefault();
    $(".wp-video-shortcode").trigger("pause");
    $(".pop_video").fadeOut();
  });

  $("#breadcrumbs").find("a:first").addClass("primer_bread").text("");

  $(".menu-hamburguesa").click(function (e) {
    e.preventDefault();
    $("#menu-cursos").fadeOut();
    $("#menu-hamburguesa").toggle();
    e.stopPropagation();
  });
  $(".icono_menu").click(function (e) {
    e.preventDefault();
    $("#menu-hamburguesa").fadeOut();
    $("#menu-cursos").toggle();
    e.stopPropagation();
  });
  // $("span:contains('Membresías')").hide();

  $(".compraRapida").click(function (e) {
    e.preventDefault();
    $(".loaderCustom").show();
    $(this).addClass("btn_desactivado");
    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: { action: "compraRapida", id: $(this).data("id") },
      success: function (response) {
        window.location.href = "/finalizar-compra/";
      },
    });
  });

  $(".cerrar_preheader").click(function (e) {
    e.preventDefault();
    setSession();
    $(".ancla_preheader").hide();
  });

  function setSession() {
    var estado = false;
    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: { action: "cierraPreheader" },
      success: function (response) {
        console.log(response);
        estado = true;
      },
    });
    return estado;
  }

  $(".membresiaAjax").click(function (e) {
    e.preventDefault();

    // $(this).siblings(".texto").fadeIn();

    // $(this).siblings(".texto").text("Verificando registro...");

    var username = $(this).siblings(".info_basica").data("username");
    var email = $(this).siblings(".info_basica").data("email");
    var course_id = $(this).siblings(".info_basica").data("course_id");
    var idwc = $(this).siblings(".info_basica").data("idwc");

    if (!email) {
      email = username;
    }

    console.log(username);
    console.log(email);
    console.log(course_id);
    console.log(idwc);
    $(this).find(".loaderCustom").fadeIn();

    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php",
      data: {
        action: "checkUser",
        username: username,
        email: email,
        course_id: course_id,
        idwc: idwc,
      },
      success: function (response) {
        if (response == 1) {
          // $(this).siblings(".texto").text(
          //   "Enrolamiento exitoso. Serás redirigido a la plataforma."
          // );
          $(".loaderCustom").fadeOut();
          // $(this).siblings(".texto").fadeOut();
          console.log(response);
          window.location.href =
            "https://isilgo-sandbox.edunext.io/courses/" +
            course_id +
            "/course/";
        } else {
          console.log(response);
          // alert(response + ". Ponte en contacto con el administrador.");
          $(".loaderCustom").fadeOut();
          // $(this).siblings(".texto").fadeOut();
        }
        // } else if (response == 2) {
        //   console.log("enrolar");
        // } else if (response == 3) {
        //   console.log("crear usuario y enrolar");
        // } else if (response == "enrollFail") {
        //   alert("El curso no tiene una ID válida. Contactar con administrador");
        //   $(".loaderCustom").fadeOut();
        // }
      },
      error: function (errorThrown) {
        console.log(errorThrown);
      },
    });
  });

  function isEmpty(el) {
    return !$.trim(el.html());
  }

  $("footer .wpcf7-submit").attr("disabled", "disabled");
  $("button.button[name=apply_coupon]").attr("disabled", "disabled");

  $("#coupon_code").on("input", function (e) {
    e.preventDefault();
    $input = $(this).val();
    if ($input.length === 0) {
      $("button.button[name=apply_coupon]").attr("disabled", "disabled");
    } else {
      $("button.button[name=apply_coupon]").removeAttr("disabled");
    }
  });

  $("footer .wpcf7-form-control").on("input", function (e) {
    e.preventDefault();
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    $correo = $(this).val();
    if ($correo.length === 0) {
      $("footer .wpcf7-submit").attr("disabled", "disabled");
    } else {
      if (testEmail.test($correo)) {
        $("footer .wpcf7-submit").removeAttr("disabled");
      } else {
        $("footer .wpcf7-submit").attr("disabled", "disabled");
      }
    }
  });

  $(".carttxtbtnwraptct").html("Carro de <span>compras</span>");

  $(".check_suscripcion").click(function (e) {
    e.preventDefault();
    $(".pop_alerta_membresia_inactiva").show();
    console.log("demo");

    $(".cancelar_desuscripcion").click(function (e) {
      e.preventDefault();
      $(".pop_alerta_membresia_inactiva").fadeOut();
    });

    return false;
  });

  $(".confirmar_desuscripcion").click(function (e) {
    e.preventDefault();
    $.ajax({
      url: "/wp-admin/admin-ajax.php?action=desuscribir",
      method: "post",
      dataType: "json",
      data: $("#valida_desuscripcion").serialize(),
    }).done(function (response) {
      if (response.success) {
        $("#botones-confirmacion-des").html(
          '<p class="alert-success p-3">' + response.message + "</p>"
        );
        window.location.reload();
      } else {
        $("#no-desuscripcion").html(response.message);
        $(".pop_alerta_membresia_inactiva").fadeOut();
      }
    });
  });
});

jQuery(document).on("scroll", function ($) {
  var scroll = jQuery(document).scrollTop();
  if (scroll > 50) {
    jQuery(".especial_profesor").slideDown();
  } else {
    jQuery(".especial_profesor").slideUp();
  }
});

const accordionItems = document.querySelectorAll(".content_acordeon");

accordionItems.forEach((item) => {
  const header = item.querySelector(".accordion-header");
  const icon = item.querySelector(".accordion-icon");

  header.addEventListener("click", () => {
    item.classList.toggle("active");
    icon.textContent = item.classList.contains("active") ? "-" : "+";
  });
});

jQuery("#ver_mas_profes").click(function (e) {
  e.preventDefault();
  var inicio = parseInt(jQuery(this).data("contadorbtn"));
  console.log(inicio);
  var final = inicio + 12;
  console.log(final);
  for (var i = inicio; i < final; i++) {
    jQuery("#" + i).show();
  }
  jQuery("#ver_mas_profes").data("contadorbtn", final);
});
