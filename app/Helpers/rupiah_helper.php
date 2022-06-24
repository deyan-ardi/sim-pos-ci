<?php

function format_rupiah($angka)
{
    return number_format($angka, 0, ',', '.');
}
