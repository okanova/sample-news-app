<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HW#5</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark text-white bg-dark">
    <a class="navbar-brand" href="#">HW #5</a>
</nav>

<div class="container">

    <div class="row p-5 justify-content-center align-items-center">

        <div class="col-md-8">


			<?php
			$errors = [];
			if ($_POST) {
				if ($_POST['studentNumber'] == "") {
					$errors['studentNumber'] = "Please provide a student number";
				}
				if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
					$errors['mail'] = "Please provide a valid e-mail";
				}
				if (count($errors) == 0) {
					$file = __DIR__.'/students/student-' . $_POST['studentNumber'] . '.txt';
					if (!file_exists($file)) {
						touch($file);
					}
					$student = fopen($file, 'w');
					$text = "";
					foreach ($_POST as $field => $value) {
						$text .= strtoupper($field) . ' : ' . $value . PHP_EOL;
					}
					fwrite($student, $text);
					fclose($student);
					?>
                    <div class="bg-success text-white p-3 m-3">
                        <h4>Success!</h4>
                        <p><?= $_POST['name'] . ' ' . $_POST['surname']; ?> successfully registered!</p>
                    </div>
					<?php
				}
			}
			?>


            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4>Register Student 
                    </h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST" class="needs-validation <?= $_POST ? 'was-validate' : ''; ?>"
                          novalidate>
                        <div class="form-group">
                            <label for="studentNumber">Student Number</label>
                            <input type="text"
                                   class="form-control <?= (isset($errors['studentNumber'])) ? 'is-invalid' : ''; ?>"
                                   name="studentNumber" id="studentNumber">
                            <!-- valid feedback -->
							<?php if (isset($errors['studentNumber'])): ?>
                                <div class="invalid-feedback">
									<?= $errors['studentNumber']; ?>
                                </div>
							<?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surname">Surname</label>
                                    <input type="text" id="surname" class="form-control" name="surname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Gender:</div>
                            <div class="col-md-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="gender" id="female" value="female"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="female">Female</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="gender" id="male" value="male"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="male">Male</label>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center mt-3">
                            <div class="col-md-4">Date of Birth:</div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="number" name="birthday-day" placeholder="DD" maxlength="2" min="1"
                                           max="31" class="form-control text-center">
                                    <input type="number" name="birthday-month" placeholder="MM" maxlength="2" min="1"
                                           max="12" class="form-control text-center">
                                    <input type="number" name="birthday-year" placeholder="YYYY" maxlength="4"
                                           min="1920" max="2020" class="form-control text-center">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center mt-3 mb-3">
                            <div class="col-md-4">Place of Birth</div>
                            <div class="col-md-8">
                                <select name="city" id="city" class="custom-select">
                                    <option disabled selected>Choose</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail Address</label>
                            <input type="email" class="form-control <?= isset($errors['mail']) ? 'is-invalid' : ''; ?>"
                                   id="mail" name="mail" value="<?= $_POST['mail'] ?? null; ?>" required>

							<?php if (isset($errors['mail'])): ?>
                                <div class="invalid-feedback">
									<?= $errors['mail']; ?>
                                </div>
							<?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <button class="btn btn-primary btn-block mt-5" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<script>
    let sehirler = [
        "ADANA",
        "ADIYAMAN",
        "AFYONKARAHİSAR",
        "AĞRI",
        "AMASYA",
        "ANKARA",
        "ANTALYA",
        "ARTVİN",
        "AYDIN",
        "BALIKESİR",
        "BİLECİKK",
        "BİNGÖL",
        "BİTLİS",
        "BOLU",
        "BURDUR",
        "BURSA",
        "ÇANAKKALE",
        "ÇANKIRI",
        "ÇORUM",
        "DENİZLİ",
        "DİYARBAKIR",
        "EDİRNE",
        "ELAZIĞ",
        "ERZİNCAN",
        "ERZURUM",
        "ESKİŞEHİR",
        "GAZİANTEP",
        "GİRESUN",
        "GÜMÜŞHANE",
        "HAKKARİ",
        "HATAY",
        "ISPARTA",
        "MERSİN",
        "İSTANBUL",
        "İZMİR",
        "KARS",
        "KASTAMONU",
        "KAYSERİ",
        "KIRKLARELİ",
        "KIRŞEHİR",
        "KOCAELİ",
        "KONYA",
        "KÜTAHYA",
        "MALATYA",
        "MANİSA",
        "KAHRAMANMARAŞ",
        "MARDİN",
        "MUĞLA",
        "MUŞ",
        "NEVŞEHİR",
        "NİĞDE",
        "ORDU",
        "RİZE",
        "SAKARYA",
        "SAMSUN",
        "SİİRT",
        "SİNOP",
        "SİVAS",
        "TEKİRDAĞ",
        "TOKAT",
        "TRABZON",
        "TUNCELİ",
        "ŞANLIURFA",
        "UŞAK",
        "VAN",
        "YOZGAT",
        "ZONGULDAK",
        "AKSARAY",
        "BAYBURT",
        "KARAMAN",
        "KIRIKKALE",
        "BATMAN",
        "ŞIRNAK",
        "BARTIN",
        "ARDAHAN",
        "IĞDIR",
        "YALOVA",
        "KARABüK",
        "KİLİS",
        "OSMANİYE",
        "DÜZCE"
    ];
    let city = document.getElementById('city');
    let cityInnerHTML = "<option disabled selected>Choose</option>";

    for (let i = 1; i < sehirler.length; i++) {
        cityInnerHTML += "<option>" + sehirler[i] + "</option>";
    }
    city.innerHTML = cityInnerHTML;

</script>
</body>
</html>
