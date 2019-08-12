(function () {
  function initMap () {
    const opt = {
      center: { lat: 34.101511, lng: -118.343705 },
      zoom: 16
    }
    const map = new google.maps.Map(document.getElementById('map'), opt)
    const marker = new google.maps.Marker({
      position: opt.center,
      map: map
    })
    const infowindow = new google.maps.InfoWindow({
      content: '7060 Hollywood Blvd, Los Angeles, CA'
    })
    marker.addListener('click', function () {
      infowindow.open(map, marker)
    })
  }

  if ($('#map').length !== 0) {
    initMap()
  }

  $('#datepicker').datepicker({
    endDate: '0d',
    autoclose: true
  })

  $('#phone-number').mask(phoneMask['CA'])
  $.mask.definitions['*'] = '[0-9]'
  $('#country').change(function () {
    const country = $(this).val()
    $('#phone-number').mask(phoneMask[country])
  })

  $('#first-form').validate({
    rules: {
      firstname: {
        required: true
      },
      lastname: {
        required: true
      },
      birthday: {
        required: true
      },
      reportSubject: {
        required: true
      },
      country: {
        required: true
      },
      phone: {
        required: true
      },
      email: {
        required: true,
        email: true,
        remote: {
          url: '/checkExistsEmail',
          type: 'post'
        }
      }
    },
    messages: {
      email: {
        remote: 'User with this email already exists.'
      }
    },
    submitHandler: function (form) {
      $(form).ajaxSubmit({
        url: '/saveUserInfo',
        type: 'post',
        enctype: 'multipart/form-data',
        success: function (data) {
          $('#filling-form').html(data)
        }
      })
    }
  })

  $('#second-form').validate({
    rules: {
      photo: {
        extension: 'png|jpe?g|gif'
      }
    },
    messages: {
      photo: {
        extension: 'Only files .jpg, .png, .gif allowed.'
      }
    },
    submitHandler: function (form) {
      $.ajax({
        url: '/updateUserInfo',
        type: 'post',
        dataType: 'text',
        data: new FormData(form),
        enctype: 'multipart/form-data',
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
          $('#filling-form').html(data)
        }
      })
    }
  })

  $(document).on('change', '#photo', function () {
    if (this.files[0].size > 2000000) {
      $('#photo-size-error').html('File must be less than 2 mb.')
      $('#submit').prop('disabled', true)
    } else {
      $('#submit').prop('disabled', false)
      $('#photo-size-error').empty()
    }
  })

  window.onload = function () {
    $('#country').append("<option value=''></option>")
    Object.keys(allCountry).forEach(function (key) {
      $('#country').append("<option value='" + key + "'" + ">" + allCountry[key] + "</option>")
    })
  }
})()
