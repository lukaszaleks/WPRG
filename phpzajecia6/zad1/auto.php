<?php
class NoweAuto {
    protected $model;
    protected $cenaEuro;
    protected $kursEuroPLN;

    public function __construct($model, $cenaEuro, $kursEuroPLN) {
        $this->model = $model;
        $this->cenaEuro = $cenaEuro;
        $this->kursEuroPLN = $kursEuroPLN;
    }

    public function ObliczCene() {
        return $this->cenaEuro * $this->kursEuroPLN;
    }
}

class AutoZDodatkami extends NoweAuto {
    protected $alarm;
    protected $radio;
    protected $klimatyzacja;

    public function __construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function ObliczCene() {
        $cena = parent::ObliczCene();
        $cena += $this->alarm + $this->radio + $this->klimatyzacja;
        return $cena;
    }
}

class Ubezpieczenie extends AutoZDodatkami {
    protected $procentowaWartoscUbezpieczenia;
    protected $liczbaLatPosiadania;

    public function __construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja, $procentowaWartoscUbezpieczenia, $liczbaLatPosiadania) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja);
        $this->procentowaWartoscUbezpieczenia = $procentowaWartoscUbezpieczenia;
        $this->liczbaLatPosiadania = $liczbaLatPosiadania;
    }

    public function ObliczCene() {
        $cenaZDodatkami = parent::ObliczCene();
        $wartoscUbezpieczenia = $this->procentowaWartoscUbezpieczenia * ($cenaZDodatkami * ((100 - $this->liczbaLatPosiadania) / 100));
        return $wartoscUbezpieczenia;
    }
}


$noweAuto = new NoweAuto("Audi A4", 30000, 4.5);
echo "Cena nowego auta w PLN: " . $noweAuto->ObliczCene() . " PLN\n";

$autoZDodatkami = new AutoZDodatkami("BMW X5", 50000, 4.3, 1000, 500, 1500);
echo "Cena auta z dodatkami w PLN: " . $autoZDodatkami->ObliczCene() . " PLN\n";

$ubezpieczenie = new Ubezpieczenie("Mercedes-Benz C-Class", 35000, 4.7, 800, 400, 1200, 0.05, 2);
echo "Wartoac ubezpieczenia w PLN: " . $ubezpieczenie->ObliczCene() . " PLN\n";
?>
