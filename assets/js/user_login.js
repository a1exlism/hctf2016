$(function() {

  /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
  // particlesJS.load('particles-js', './particles.json', function() {
  //   console.log('callback - particles.js config loaded');
  // });

  particlesJS('particles-js', {
    "particles": {
      "number": {
        "value": 40,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": ["#3cba54",
                  "#f4c20d",
                  "#db3236",
                  "#4885ed"]
      },
      "shape": {
        "type": "circle",
        "stroke": {
          "width": 0,
          "color": "#000"
        },
        "polygon": {
          "nb_sides": 6
        },
        "image": {
          "src": "img/github.svg",
          "width": 100,
          "height": 100
        }
      },
      "opacity": {
        "value": 0.6,
        "random": false,
        "anim": {
          "enable": false,
          "speed": 1,
          "opacity_min": 0.1,
          "sync": false
        }
      },
      "size": {
        "comment": "particles的大小",
        "value": 3,
        "random": true,
        "anim": {
          "enable": false,
          "speed": 40,
          "size_min": 0.2,
          "sync": false
        }
      },
      "line_linked": {
        "enable": true,
        "distance": 150,
        "color": "#ffffff",
        "opacity": 0.4,
        "width": 1
      },
      "move": {
        "enable": true,
        "speed": 5,
        "direction": "none",
        "random": false,
        "straight": false,
        "out_mode": "out",
        "bounce": false,
        "attract": {
          "enable": true,
          "rotateX": 600,
          "rotateY": 1200
        }
      }
    },
    "interactivity": {
      "detect_on": "canvas",
      "events": {
        "onhover": {
          "comment": "hover效果",
          "enable": true,
          "mode": "grab"
        },
        "onclick": {
          "comment": "点击效果",
          "enable": true,
          "mode": "push"
        },
        "resize": true
      },
      "modes": {
        "grab": {
          "distance": 180,
          "line_linked": {
            "opacity": 0.6
          }
        },
        "bubble": {
          "distance": 800,
          "size": 80,
          "duration": 2,
          "opacity": 0.8,
          "speed": 3
        },
        "repulse": {
          "distance": 400,
          "duration": 0.4
        },
        "push": {
          "particles_nb": 2
        },
        "remove": {
          "particles_nb": 2
        }
      }
    },
    "retina_detect": true
  });

  /* Login/Register panel switch */
  $('#login-form-link').click(function(event) {
    $('#form-login').delay(150).fadeIn(150);
    $('#form-register').fadeOut(150);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    event.preventDefault(); //防止url被打开
  });
  $('#register-form-link').click(function(event) {
    $('#form-register').delay(150).fadeIn(150);
    $('#form-login').fadeOut(150);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    event.preventDefault(); //防止url被打开
  });
});
