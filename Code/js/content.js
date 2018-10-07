/*$(window).load(function() {
	$(".preloader").fadeOut("1000");
})*/

$.fn.goValidate = function() {
    var $form = this,
        $inputs = $form.find('input:email, input:password');

    var validators = {
        email: {
            regex: /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/
        }
    };
    var validate = function(klass, value) {
        var isValid = true,
            error = '';

        if (!value && /required/.test(klass)) {
            error = 'Ce champ est requis.';
            isValid = false;
        } else {
            klass = klass.split(/\s/);
            $.each(klass, function(i, k){
                if (validators[k]) {
                    if (value && !validators[k].regex.test(value)) {
                        isValid = false;
                        error = validators[k].error;
                    }
                }
            });
        }
        return {
            isValid: isValid,
            error: error
        }
    };
    var showError = function($input) {
        var klass = $input.attr('class'),
            value = $input.val(),
            test = validate(klass, value);

        $input.removeClass('invalid');

        if (!test.isValid) {
            $input.addClass('invalid');
            if(typeof $input.data("shown") == "undefined" || $input.data("shown") == false){
               $input.popover('show');
            }

        }
      	else {
        	$input.popover('hide');
            $input.parent().removeClass('has-error').addClass('has-success');
      	}
    };

    $inputs.keyup(function() {
        showError($(this));
    });

    $inputs.on('shown.bs.popover', function () {
  		$(this).data("shown",true);
	});

    $inputs.on('hidden.bs.popover', function () {
  		$(this).data("shown",false);
	});

    $form.submit(function(e) {

        $inputs.each(function() {
          if ($(this).is('.required')) {
            //showError($(this)); /* rem comment to enable initial display of validation rules */
          }
    	});

        if ($form.find('input.invalid').length) {
            e.preventDefault();
            alert('Ces champs ne sont pas valides !');
        }
    });
    return this;
};

$('form').goValidate();
