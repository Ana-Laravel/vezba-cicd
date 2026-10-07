from kalkulator import saberi, oduzmi, pomnozi


def test_saberi():
    assert saberi(2, 3) == 5


def test_oduzmi():
    assert oduzmi(10, 4) == 6


def test_pomnozi():
    assert pomnozi(3, 4) == 12
