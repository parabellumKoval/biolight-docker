import { getRequestURL, sendRedirect } from 'h3'

const redirects = [
    {
        "from": "/ru/",
        "to": "/"
    },
    {
        "from": "/ru/chto-takoe-bady-vsya-pravda-o-badah/",
        "to": "/blog/chto-takoe-bady-vsya-pravda-o-badah"
    },
    {
        "from": "/ru/differences-between-bad-and-medication/",
        "to": "/blog/kak-otlichit-bad-ot-lekarstva"
    },
    {
        "from": "/ru/garantiya-kachestva/",
        "to": "/garantiya-kachestva"
    },
    {
        "from": "/ru/uslugi-rozliva-napitkov-i-masla/",
        "to": "/usluga-razliva-napitkov-i-masel"
    },
    {
        "from": "/ru/vsya-produktsiya/antiseptik-75-na-osnove-izopropilovogo-spirta-100-ml-new/",
        "to": "/antiseptik-optom/antiseptik-75-na-osnove-izopropilovogo-spirta-100-ml-2"
    },
    {
        "from": "/ru/vsya-produktsiya/antiseptik-75-na-osnove-izopropilovogo-spirta-100-ml/",
        "to": "/antiseptik-optom/antiseptik-75-na-osnove-izopropilovogo-spirta-100-ml"
    },
    {
        "from": "/ru/vsya-produktsiya/antiseptik-75-na-osnove-izopropilovogo-spirta-1000-ml-new/",
        "to": "/antiseptik-optom/antiseptik-75-na-osnove-izopropilovogo-spirta-1000-ml-2"
    },
    {
        "from": "/ru/vsya-produktsiya/antiseptik-75-na-osnove-izopropilovogo-spirta-1000-ml/",
        "to": "/antiseptik-optom/antiseptik-75-na-osnove-izopropilovogo-spirta-1000-ml"
    },
    {
        "from": "/ru/vsya-produktsiya/antiseptik-75-na-osnove-izopropilovogo-spirta-60-ml/",
        "to": "/antiseptik-optom/antiseptik-75-na-osnove-izopropilovogo-spirta-60-ml"
    },
    {
        "from": "/ru/vsya-produktsiya/dashi-kombu-sloevishha-rezannaya/",
        "to": "/vodorosli/dashi-kombu-sloevishcha-rezannaya"
    },
    {
        "from": "/ru/vsya-produktsiya/golubaya-spirulina-mikronizirovannaya-pudra/",
        "to": "/vodorosli/golubaya-spirulina-mikronizirovannaya-pudra"
    },
    {
        "from": "/ru/vsya-produktsiya/griby-muer/",
        "to": "/vodorosli/griby-muer"
    },
    {
        "from": "/ru/vsya-produktsiya/hlorella-tabletirovannaya/",
        "to": "/vodorosli/hlorella-tabletirovannaya"
    },
    {
        "from": "/ru/vsya-produktsiya/kapsuly-zhelatinovye-tverdye-0/",
        "to": "/zhelatinovye-kapsuly/kapsuly-zhelatinovye-tverdye-0"
    },
    {
        "from": "/ru/vsya-produktsiya/kapsuly-zhelatinovye-tverdye-1/",
        "to": "/zhelatinovye-kapsuly/kapsuly-zhelatinovye-tverdye-1"
    },
    {
        "from": "/ru/vsya-produktsiya/kapsuly-zhelatinovye-tverdye-2/",
        "to": "/zhelatinovye-kapsuly/kapsuly-zhelatinovye-tverdye-2"
    },
    {
        "from": "/ru/vsya-produktsiya/kapsuly-zhelatinovye-tverdye-3/",
        "to": "/zhelatinovye-kapsuly/kapsuly-zhelatinovye-tverdye-3"
    },
    {
        "from": "/ru/vsya-produktsiya/kapsuly-zhelatinovye-tverdye-4/",
        "to": "/zhelatinovye-kapsuly/kapsuly-zhelatinovye-tverdye-4"
    },
    {
        "from": "/ru/vsya-produktsiya/laminariya-listovaya/",
        "to": "/vodorosli/laminariya-listovaya"
    },
    {
        "from": "/ru/vsya-produktsiya/laminariya-mikronizirovannaya-pudra/",
        "to": "/vodorosli/laminariya-mikronizirovannaya-pudra"
    },
    {
        "from": "/ru/vsya-produktsiya/laminariya-rremium-kachestva-portsionnaya-20-gr/",
        "to": "/vodorosli/laminariya-rremium-kachestva-porcionnaya-20-gr"
    },
    {
        "from": "/ru/vsya-produktsiya/laminariya-solnechnoj-sushki-rezannaya/",
        "to": "/vodorosli/laminariya-solnechnoy-sushki-rezannaya"
    },
    {
        "from": "/ru/vsya-produktsiya/laminariya-sublimirovannaya-rezannaya/",
        "to": "/vodorosli/laminariya-sublimirovannaya-rezannaya"
    },
    {
        "from": "/ru/vsya-produktsiya/letsitin-podsolnechnyj/",
        "to": "/lecitin-podsolnechnyy/lecitin-podsolnechnyy"
    },
    {
        "from": "/ru/vsya-produktsiya/rapeseed-lecithin/",
        "to": "/lecitin-podsolnechnyy"
    },
    {
        "from": "/ru/vsya-produktsiya/spirulina-mikronizirovannaya-pudra/",
        "to": "/vodorosli/spirulina-mikronizirovannaya-pudra"
    },
    {
        "from": "/ru/vsya-produktsiya/spirulina-tabletirovannaya/",
        "to": "/vodorosli/spirulina-tabletirovannaya"
    },
    {
        "from": "/ru/vsya-produktsiya/ulva-laktuka-mikronizirovannaya/",
        "to": "/vodorosli/ulva-laktuka-mikronizirovannaya"
    },
    {
        "from": "/ru/vsya-produktsiya/vakame/",
        "to": "/vodorosli/vakame"
    },
    {
        "from": "/ru/vsya-produktsiya/vlagopoglatiteli-paket-3g/",
        "to": "/vlagopoglotiteli/vlagopoglotiteli-paket-3g"
    },
    {
        "from": "/ru/vsya-produktsiya/vlagopoglotiteli-kanistry-3g/",
        "to": "/vlagopoglotiteli/vlagopoglotiteli-kanistry-3g"
    },
    {
        "from": "/ru/vsya-produktsiya/vlagopoglotiteli-pakety-10g/",
        "to": "/vlagopoglotiteli/vlagopoglotiteli-paket-10g"
    },
    {
        "from": "/ru/vsya-produktsiya/vlagopoglotiteli-pakety-2g/",
        "to": "/vlagopoglotiteli/vlagopoglotiteli-paket-2g"
    },
    {
        "from": "/ru/proizvodstvo/",
        "to": "/proizvodstvo-badov-v-ukraine"
    },
    {
        "from": "/ru/fasovka-gotovoj-produktsii/",
        "to": "/fasovka-tabletok-i-poroshkov"
    },
    {
        "from": "/ru/blisterovanie/",
        "to": "/blisterovanie"
    },
    {
        "from": "/ru/kapsulirovanie-badov-i-poroshkov/",
        "to": "/kapsulirovanie-badov-i-poroshkov"
    },
    {
        "from": "/ru/tabletirovanie/",
        "to": "/tabletirovanie"
    },
    {
        "from": "/ru/proizvodstvo-antiseptikov/",
        "to": "/proizvodstvo-antiseptikov"
    },
    {
        "from": "/ru/uslugi-rozliva-napitkov-i-masla/",
        "to": "/usluga-razliva-napitkov-i-masel"
    },
    {
        "from": "/ru/razrabotka-retseptur/",
        "to": "/razrabotka-receptur"
    },
    {
        "from": "/ru/razrabotka-tehnicheskoj-dokumentatsii/",
        "to": "/razrabotka-tehnicheskoy-dokkumentacii"
    },
    {
        "from": "/ru/razrabotka-logisticheskih-marshrutov-i-otpravka-gruzov-po-ukraine-i-es/",
        "to": "/sostavlenie-marshrutov-dvizheniya-transporta"
    },
    {
        "from": "/ru/rozliv-antiseptika/",
        "to": "/rozliv-antiseptika"
    },
    {
        "from": "/ru/what-is-silica-gel/",
        "to": "/vlagopoglotiteli"
    },
    {
        "from": "/ru/kapsuly-zhelatinovye-tverdye/",
        "to": "/zhelatinovye-kapsuly"
    },
    {
        "from": "/ru/kontakty/",
        "to": "/contacts"
    },
    {
        "from": "/ru/pishhevaya-tsennost-produktov/",
        "to": "/blog/pishchevaya-cennost-produktov"
    },
    {
        "from": "/ru/vkladyshi-dlya-zapajki/",
        "to": "/vkladyshi-dlya-indukcionnoy-zapayki"
    },
    {
        "from": "/ru/tara/",
        "to": "https://biolight.com.ua/"
    },
    {
        "from": "/ru/vlagopoglotiteli/",
        "to": "/vlagopoglotiteli"
    },
    {
        "from": "/ru/o-kompanii/",
        "to": "/o-kompanii"
    },
    {
        "from": "/ru/vodorosli/",
        "to": "/vodorosli"
    },
    {
        "from": "/ru/blog/",
        "to": "/blog"
    },
    {
        "from": "/ru/letsitin-podsolnechnyj/",
        "to": "/lecitin-podsolnechnyy"
    },
    {
        "from": "/ru/kontrol-kachesta/",
        "to": "/kontrol-kachestva"
    },
    {
        "from": "/ru/vodorosli/page/2/",
        "to": "/vodorosli"
    },
    {
        "from": "/ru/mikrobiologicheskij-kontrol/",
        "to": "/mikrobiologicheskiy-kontrol"
    },
    {
        "from": "/ru/obespechenie-kachestva/",
        "to": "/obespechenie-kachestva"
    },
    {
        "from": "/ru/fiziko-himicheskij-kontrol/",
        "to": "/fiziko-himicheskiy-kontrol"
    },
    {
        "from": "/ru/vsya-produktsiya/vlagopoglotiteli-pakety-5g/",
        "to": "/vlagopoglotiteli/vlagopoglotiteli-paket-5g"
    }
]

export default defineEventHandler((event) => {
  const requestUrl = getRequestURL(event)
  const redirect = redirects.find((item) => item.from === requestUrl.pathname)

  if (redirect) {
    return sendRedirect(event, `${redirect.to}${requestUrl.search || ''}`, 301)
  }
})
