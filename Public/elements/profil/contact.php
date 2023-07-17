<div class="cc-contact-information" style="background-image: url('Public/assets/images/univers1.jpg');">
    <div class="container">
        <div class="cc-contact">
            <div class="row">
                <div class="col-sm-12 col-lg-9">
                    <div class="card mb-0" data-aos="zoom-in">
                        <div class="h4 text-center title" id="toContact">Pour me contacter</div>
                        <hr class="w-75">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <form action="traitement.php" method="post">
                                        <div class="p pb-3" id="laisseMess"><strong>Laissez moi un message</strong></div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Nom" required="required">
                                                </div>
                                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-user-circle"></i></span>
                                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Prénom" required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                                    <input class="form-control" type="text" name="sujet" placeholder="Sujet" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="input-group"><span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                    <input class="form-control" type="email" name="email" placeholder="E-mail" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <div class="form-group">
                                                    <textarea class="form-control editor" name="message" placeholder="Votre message" required="required"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="hidden" name="raison" id="recaptchaResponse">
                                                <button class="btn btn-primary" type="submit">Envoyez votre message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>