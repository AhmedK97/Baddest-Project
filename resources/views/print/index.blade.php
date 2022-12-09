<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">


    <meta name="apple-mobile-web-app-title" content="CodePen">

    <link rel="shortcut icon" type="image/x-icon"
          href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />

    <link rel="mask-icon" type="image/x-icon"
          href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg"
          color="#111" />

    <link href="{{ asset('css/print.css') }}" rel="stylesheet">
    <title>Elite Dental Center</title>

    <script>
        window.console = window.console || function(t) {};
    </script>

    <script>
        if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
    </script>
    <style>
        th {
            text-align: center !important;
        }

        td {
            text-align: center !important;
        }

        @media print {
            .noPrint {
                display: none;
            }
        }
    </style>

</head>





<body translate="no">

    <button onclick="window.print();" class="noPrint">
        Print
    </button>


    <head>
        <meta charset="utf-8">
        <title>Invoice</title>
        <link rel="stylesheet" href="style.css">
        <link rel="license" href="https://www.opensource.org/licenses/mit-license/">
        <script src="script.js"></script>
    </head>

    <body>
        <header>
            <h1>Invoice</h1>
            <address contenteditable>
                <h2 style="font-size: 15px">{{ $project->name }}</h2>
                <h2 style="font-size: 15px">{{ $project->address }}</h2>
                <h2 style="font-size: 15px">{{ $project->phone }}</h2>
            </address>
            <span><img alt="" src="http://www.jonathantneal.com/examples/invoice/logo.png"><input type="file" accept="image/*"></span>
        </header>
        <article style="    margin: 0;     height: 600px;">
            <img style="
            height: 95px;
            width: 135px;
            margin-top: -40px;
        " src="/images/logop.png" alt="" srcset="">
            <address>
                <div class="d-flex flex-row bd-highlight mb-3 ">
                    <p>Elite Dental Center </p>

                </div>
            </address>
            <table class="meta">

                <tr>
                    <th><span contenteditable>Date</span></th>
                    <td><span contenteditable>{{ now() }}</span></td>
                </tr>
                <tr>
                    <th><span>Amount Due</span></th>
                    <td>{{ $total }} EGP</td>
                </tr>
            </table>



            <div class="d-flex flex-row">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="font-size: 15px" scope="col"><strong>Items</strong></th>

                            <th style="font-size: 15px" scope="col"><strong>Quantity</strong></th>
                            <th style="font-size: 15px" scope="col"><strong>Price</strong></th>
                        </tr>
                    </thead>
                    @foreach ($project->comments as $case )
                    <tbody>
                        <tr>
                            @if ($case->comment == 0 )
                            <th contenteditable scope="row">خلع عادي </th>
                            @elseif ($case->comment == 1)
                            <th contenteditable scope="row">عصب</th>
                            @elseif ($case->comment == 2)
                            <th contenteditable scope="row">لثه</th>
                            @elseif ($case->comment == 3)
                            <th contenteditable scope="row">تنظيف جير</th>
                            @elseif ($case->comment == 4)
                            <th contenteditable scope="row">تبيض</th>
                            @elseif ($case->comment == 5)
                            <th contenteditable scope="row"> خلع جراحي</th>
                            @elseif ($case->comment == 6)
                            <th contenteditable scope="row">زراعه</th>
                            @elseif ($case->comment == 7)
                            <th contenteditable scope="row">تجميل</th>
                            @elseif ($case->comment == 8)
                            <th contenteditable scope="row"> خلع اطفال</th>
                            @elseif ($case->comment == 9)
                            <th contenteditable scope="row">حشو عادي اطفال</th>
                            @elseif ($case->comment == 10)
                            <th contenteditable  scope="row">حافظ مسافه للاطفال</th>
                            @elseif ($case->comment == 11)
                            <th contenteditable  scope="row">طرابيش اطفال</th>
                            @elseif ($case->comment == 12)
                            <th contenteditable  scope="row"> عصب اطفال</th>
                            @elseif ($case->comment == 13)
                            <th contenteditable  scope="row">تركيبات متحركه</th>
                            @elseif ($case->comment == 14)
                            <th contenteditable  scope="row">دعامه</th>
                            @elseif ($case->comment == 15)
                            <th contenteditable  scope="row">اشاعه</th>
                            @elseif ($case->comment == 16)
                            <th contenteditable  scope="row">ZIRCON-EMAX</th>
                            @elseif ($case->comment == 17)
                            <th contenteditable  scope="row"> ZIRCON</th>
                            @elseif ($case->comment == 18)
                            <th contenteditable  scope="row"> EMAX</th>
                            @elseif ($case->comment == 19)
                            <th contenteditable  scope="row">VENEER</th>
                            @elseif ($case->comment == 20)
                            <th contenteditable  scope="row"> PORCELAIN</th>
                            @else
                            <th scope="row"> تقــويم</th>
                            @endif
                            <td>{{ $case->num }} </td>
                            <td>{{ $case->bill }} EPG </td>



                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>






            <br><br><br>

            <table class="balance">
                <tr>
                    <th><span >Total</span></th>
                    <td>{{ $total }} EGP</td>
                </tr>
                <tr>
                    <th><span >Amount Paid</span></th>
                    <td>{{ $paid }} EGP</td>
                </tr>
                <tr>
                    <th><span >Balance Due</span></th>
                    <td>{{ $total - $paid }} EGP</span></td>
                </tr>
            </table>
        </article>
        <aside style="height: 100px;">
            <h1><span contenteditable>Additional Notes</span></h1>
            <div contenteditable>
                <p>.</p>
            </div>
        </aside>


        <footer>
            <div>
                <h1 style="border-bottom: 1px solid black">Elite Dental Center</h1>
            </div>
            <div style="display: flex ; justify-content: space-between">
                <div style="text-align: center">
                    <p style="margin: 5px; font-weight: bold;">: العــــنوان</p>
                    <p style="margin: 5px;">نجع حمادي </p>
                    <p style="margin: 5px;">شارع حسني مبارك</p>
                    <p style="margin: 5px;">أعلي سنتر العسقلاني</p>
                </div>

                <div style="text-align: center">
                    <p style="margin: 5px;font-weight: bold;">نجع حمادي</p>
                    <p style="margin: 5px;"> 01030312109 📞</p>
                    <p style="margin: 5px;"> 01120078081 📞</p>
                </div>

                <div style="text-align: center">
                    <p style="margin: 5px;font-weight: bold;">قـــنــا</p>
                    <p style="margin: 5px;"> 01016038828 📞</p>
                </div>

                <div style="text-align: center">
                    <p style="margin: 5px; font-weight: bold;">: العــــنوان</p>
                    <p style="margin: 5px;">قـــــنـا</p>
                    <p style="margin: 5px;">شارع مصطفي كامل </p>
                    <p style="margin: 5px;">أمام فاميلي مول</p>
                </div>
            </div>
        </footer>
    </body>

</html>













<script src="https://cpwebassets.codepen.io/assets/common/stopExecutionOnTimeout-1b93190375e9ccc259df3a57c1abc0e64599724ae30d7ea4c6877eb615f89387.js">
</script>


<script id="rendered-js">
    /* Shivving (IE8 is not supported, but at least it won't look as awful)
/* ========================================================================== */

(function (document) {
  var
  head = document.head = document.getElementsByTagName('head')[0] || document.documentElement,
  elements = 'article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output picture progress section summary time video x'.split(' '),
  elementsLength = elements.length,
  elementsIndex = 0,
  element;

  while (elementsIndex < elementsLength) {if (window.CP.shouldStopExecution(0)) break;
    element = document.createElement(elements[++elementsIndex]);
  }window.CP.exitedLoop(0);

  element.innerHTML = 'x<style>' +
  'article,aside,details,figcaption,figure,footer,header,hgroup,nav,section{display:block}' +
  'audio[controls],canvas,video{display:inline-block}' +
  '[hidden],audio{display:none}' +
  'mark{background:#FF0;color:#000}' +
  '</style>';

  return head.insertBefore(element.lastChild, head.firstChild);
})(document);

/* Prototyping
/* ========================================================================== */

(function (window, ElementPrototype, ArrayPrototype, polyfill) {
  function NodeList() {[polyfill];}
  NodeList.prototype.length = ArrayPrototype.length;

  ElementPrototype.matchesSelector = ElementPrototype.matchesSelector ||
  ElementPrototype.mozMatchesSelector ||
  ElementPrototype.msMatchesSelector ||
  ElementPrototype.oMatchesSelector ||
  ElementPrototype.webkitMatchesSelector ||
  function matchesSelector(selector) {
    return ArrayPrototype.indexOf.call(this.parentNode.querySelectorAll(selector), this) > -1;
  };

  ElementPrototype.ancestorQuerySelectorAll = ElementPrototype.ancestorQuerySelectorAll ||
  ElementPrototype.mozAncestorQuerySelectorAll ||
  ElementPrototype.msAncestorQuerySelectorAll ||
  ElementPrototype.oAncestorQuerySelectorAll ||
  ElementPrototype.webkitAncestorQuerySelectorAll ||
  function ancestorQuerySelectorAll(selector) {
    for (var cite = this, newNodeList = new NodeList(); cite = cite.parentElement;) {if (window.CP.shouldStopExecution(1)) break;
      if (cite.matchesSelector(selector)) ArrayPrototype.push.call(newNodeList, cite);
    }window.CP.exitedLoop(1);

    return newNodeList;
  };

  ElementPrototype.ancestorQuerySelector = ElementPrototype.ancestorQuerySelector ||
  ElementPrototype.mozAncestorQuerySelector ||
  ElementPrototype.msAncestorQuerySelector ||
  ElementPrototype.oAncestorQuerySelector ||
  ElementPrototype.webkitAncestorQuerySelector ||
  function ancestorQuerySelector(selector) {
    return this.ancestorQuerySelectorAll(selector)[0] || null;
  };
})(this, Element.prototype, Array.prototype);

/* Helper Functions
/* ========================================================================== */

function generateTableRow() {
  var emptyColumn = document.createElement('tr');

  emptyColumn.innerHTML = '<td><a class="cut">-</a><span contenteditable></span></td>' +
  '<td><span contenteditable></span></td>' +
  '<td><span data-prefix>$</span><span contenteditable>0.00</span></td>' +
  '<td><span contenteditable>0</span></td>' +
  '<td><span data-prefix>$</span><span>0.00</span></td>';

  return emptyColumn;
}

function parseFloatHTML(element) {
  return parseFloat(element.innerHTML.replace(/[^\d\.\-]+/g, '')) || 0;
}

function parsePrice(number) {
  return number.toFixed(2).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1,');
}

/* Update Number
/* ========================================================================== */

function updateNumber(e) {
  var
  activeElement = document.activeElement,
  value = parseFloat(activeElement.innerHTML),
  wasPrice = activeElement.innerHTML == parsePrice(parseFloatHTML(activeElement));

  if (!isNaN(value) && (e.keyCode == 38 || e.keyCode == 40 || e.wheelDeltaY)) {
    e.preventDefault();

    value += e.keyCode == 38 ? 1 : e.keyCode == 40 ? -1 : Math.round(e.wheelDelta * 0.025);
    value = Math.max(value, 0);

    activeElement.innerHTML = wasPrice ? parsePrice(value) : value;
  }

  updateInvoice();
}

/* Update Invoice
/* ========================================================================== */

function updateInvoice() {
  var total = 0;
  var cells, price, total, a, i;

  // update inventory cells
  // ======================

  for (var a = document.querySelectorAll('table.inventory tbody tr'), i = 0; a[i]; ++i) {if (window.CP.shouldStopExecution(2)) break;
    // get inventory row cells
    cells = a[i].querySelectorAll('span:last-child');

    // set price as cell[2] * cell[3]
    price = parseFloatHTML(cells[2]) * parseFloatHTML(cells[3]);

    // add price to total
    total += price;

    // set row total
    cells[4].innerHTML = price;
  }

  // update balance cells
  // ====================

  // get balance cells
  window.CP.exitedLoop(2);cells = document.querySelectorAll('table.balance td:last-child span:last-child');

  // set total
  cells[0].innerHTML = total;

  // set balance and meta balance
  cells[2].innerHTML = document.querySelector('table.meta tr:last-child td:last-child span:last-child').innerHTML = parsePrice(total - parseFloatHTML(cells[1]));

  // update prefix formatting
  // ========================

  var prefix = document.querySelector('#prefix').innerHTML;
  for (a = document.querySelectorAll('[data-prefix]'), i = 0; a[i]; ++i) {if (window.CP.shouldStopExecution(3)) break;a[i].innerHTML = prefix;}

  // update price formatting
  // =======================
  window.CP.exitedLoop(3);
  for (a = document.querySelectorAll('span[data-prefix] + span'), i = 0; a[i]; ++i) {if (window.CP.shouldStopExecution(4)) break;if (document.activeElement != a[i]) a[i].innerHTML = parsePrice(parseFloatHTML(a[i]));}window.CP.exitedLoop(4);
}

/* On Content Load
/* ========================================================================== */

function onContentLoad() {
  updateInvoice();

  var
  input = document.querySelector('input'),
  image = document.querySelector('img');

  function onClick(e) {
    var element = e.target.querySelector('[contenteditable]'),row;

    element && e.target != document.documentElement && e.target != document.body && element.focus();

    if (e.target.matchesSelector('.add')) {
      document.querySelector('table.inventory tbody').appendChild(generateTableRow());
    } else
    if (e.target.className == 'cut') {
      row = e.target.ancestorQuerySelector('tr');

      row.parentNode.removeChild(row);
    }

    updateInvoice();
  }

  function onEnterCancel(e) {
    e.preventDefault();

    image.classList.add('hover');
  }

  function onLeaveCancel(e) {
    e.preventDefault();

    image.classList.remove('hover');
  }

  function onFileInput(e) {
    image.classList.remove('hover');

    var
    reader = new FileReader(),
    files = e.dataTransfer ? e.dataTransfer.files : e.target.files,
    i = 0;

    reader.onload = onFileLoad;

    while (files[i]) {if (window.CP.shouldStopExecution(5)) break;reader.readAsDataURL(files[i++]);}window.CP.exitedLoop(5);
  }

  function onFileLoad(e) {
    var data = e.target.result;

    image.src = data;
  }

  if (window.addEventListener) {
    document.addEventListener('click', onClick);

    document.addEventListener('mousewheel', updateNumber);
    document.addEventListener('keydown', updateNumber);

    document.addEventListener('keydown', updateInvoice);
    document.addEventListener('keyup', updateInvoice);

    input.addEventListener('focus', onEnterCancel);
    input.addEventListener('mouseover', onEnterCancel);
    input.addEventListener('dragover', onEnterCancel);
    input.addEventListener('dragenter', onEnterCancel);

    input.addEventListener('blur', onLeaveCancel);
    input.addEventListener('dragleave', onLeaveCancel);
    input.addEventListener('mouseout', onLeaveCancel);

    input.addEventListener('drop', onFileInput);
    input.addEventListener('change', onFileInput);
  }
}

window.addEventListener && document.addEventListener('DOMContentLoaded', onContentLoad);
//# sourceURL=pen.js
</script>



</body>

</html>
