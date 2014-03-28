<!DOCTYPE html>
<head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-6">
    <form method="post" class="contact-form" novalidate="novalidate">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">                                    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-smile-o"></i></span>
                        <input type="text" required="" placeholder="Nombre" class="form-control" name="name" id="name">
                    </div>                
                </div>
                <div class="form-group">                                    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                        <input type="text" required="" placeholder="Email" class="form-control" name="email" id="email">
                    </div>                
                </div>                    
            </div>
            <div class="col-md-6">
                <div class="form-group">                        
                    <textarea placeholder="Mensaje" required="required" cols="25" rows="9" class="form-control" id="message" name="message"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <button id="btnContactUs" class="btn btn-primary pull-right" type="submit">Enviar</button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>
<script>
jQuery('.contact-form').each(function() {
        jQuery(this).validate({
            rules: {
                name: {minlength: 3},
                email: {email: true},
                message: {minlength: 50}
            },
            messages: {
                name: 'Debes agregar mínimo 3 letras',
                email: 'Debes colocar un e-Mail válido.',
                message: 'Debes ingresar al menos 50 letras en tu mensaje.'
            },
            submitHandler: function(form) {
                jQuery.ajax({
                    url: ajaxurl,
                    method: 'POST',
                    data: jQuery(form).serialize()+'&action=send_mail',
                    dataType: 'json',
                    beforeSend: function() {
                        //runSpinner();
                    },
                    success: function(d) {
                        if (d.state) {
                            successNoty(d.message, 'success', 2000);
                            jQuery(form).reset();
                        } else {
                            successNoty(d.message, 'error');
                            console.log(d.console);
                        }
                    }
                });
                return false;
            }
        });
    });
</script>
</body>
</html>
