<?php

function getTextCountry() {
    return 'España';
}

function getTextPhone() {
    return 'Teléfono';
}

echo '<footer>
    <div class="redes">
        <a href="https://www.facebook.com/Hotel-Plaza-Nueva-176542882374100"
        target="_blank">
            <img src="/images/facebook.png" alt="Facebook">
        </a>
        <a href="https://twitter.com/HOTELPLAZANUEVA" target="_blank">
            <img src="/images/twitter.png" alt="twitter">
        </a>
        <a href=
        "https://www.google.es/maps/place/Hotel+Plaza+Nueva/@37.17704,\
        -3.5984897,17z/data=!3m1!4b1!4m2!3m1!1s0xd71fcb8cb9390e1:\
        0x9253186efccf153a" target="_blank">
            <img src="/images/google.png" alt="Google">
        </a>
    </div>
    <div class="info_footer">
        <img src="/images/logo.png" alt="Logo">
        <pre id="info">
        Hotel Plaza Nueva
        Imprenta, nº 2. 18010 Granada, Granada,' . getTextCountry() . '
        ' . getTextPhone() . ': +34 958 215 273. ,	Fax: +34 958 225 765
        info@hotel-plazanueva.com
        </pre>
    </div>


</footer>';

echo '<script src="/JS/formulario.js"></script>';
echo '<script src="/JS/slider.js"></script>';

?>
