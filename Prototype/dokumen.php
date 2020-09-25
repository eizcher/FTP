<?php include("koneksi.php"); ?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
<meta name="google" value="notranslate">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="title icon" href="images/title-img.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Dashboard</title>
  </head>
  <body>
    <?php 
	    session_start();
  
	    // cek apakah yang mengakses halaman ini sudah login
	    if($_SESSION['level']==""){
		    header("location:index.php?pesan=gagal");
	    }
 
	?>
    <!-- navbar -->
    <nav class="navbar navbar-expand-md navbar-light">
      <button class="navbar-toggler ml-auto mb-2 bg-light" type="button" data-toggle="collapse" data-target="#myNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="myNavbar">
        <div class="container-fluid">
          <div class="row">
            <!-- sidebar -->
            <div class="col-xl-2 col-lg-3 col-md-4 sidebar  fixed-top" backgroundcolor="red">
            <div class="text-center">
            <img src="images/telkom_indonesia_logo.png"  width="130" >
            </div>
      <a href="#" class="navbar-brand text-white d-block mx-auto text-center mb-4 "></a>
              <div class="bottom-border text-white d-block mx-auto text-center">
                <p><?php echo $_SESSION['username']; ?></p>
              </div>
              <ul class="navbar-nav flex-column mt-4">
                <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white p-3 mb-2 current"><i class="fas fa-home text-light fa-lg mr-3"></i>Dashboard</a></li>
                <li class="nav-item"><a href="data_user.php" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-user text-light fa-lg mr-3"></i>Data User</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-user text-light fa-lg mr-3"></i>Dokumen</a></li>
                <li class="nav-item"><a href="log.php" class="nav-link text-white p-3 mb-2 sidebar-link"><i class="fas fa-user text-light fa-lg mr-3"></i>LOG</a></li>
              </ul>
            </div>
            <!-- end of sidebar -->

            <!-- top-nav -->
            <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-light fixed-top py-2 top-navbar">
              <div class="row align-items-center">
                <div class="col-md-4">
                  <h4 class="text-danger text-uppercase mb-0">Dashboard</h4>
                </div>
                <div class="col-md-8">
                  <ul class="navbar-nav">
                     <li class="nav-item ml-md-auto "><a href="logout.php" class="nav-link" ><i class="fas fa-sign-out-alt text-danger fa-lg"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- end of top-nav -->
          </div>
        </div>
      </div>
    </nav>
    <!-- end of navbar -->

    <!-- modal -->
    <div class="modal fade" id="sign-out">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Want to leave?</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            Press logout to leave
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Logout</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end of modal -->
    <script>
function addRow(name, url, isdir,
    size, size_string, date_modified, date_modified_string) {
  if (name == "." || name == "..")
    return;

  var root = document.location.pathname;
  if (root.substr(-1) !== "/")
    root += "/";

  var tbody = document.getElementById("tbody");
  var row = document.createElement("tr");
  var file_cell = document.createElement("td");
  var link = document.createElement("a");

  link.className = isdir ? "icon dir" : "icon file";

  if (isdir) {
    name = name + "/";
    url = url + "/";
    size = 0;
    size_string = "";
  } else {
    link.draggable = "true";
    link.addEventListener("dragstart", onDragStart, false);
  }
  link.innerText = name;
  link.href = root + url;

  file_cell.dataset.value = name;
  file_cell.appendChild(link);

  row.appendChild(file_cell);
  row.appendChild(createCell(size, size_string));
  row.appendChild(createCell(date_modified, date_modified_string));

  tbody.appendChild(row);
}

function onDragStart(e) {
  var el = e.srcElement;
  var name = el.innerText.replace(":", "");
  var download_url_data = "application/octet-stream:" + name + ":" + el.href;
  e.dataTransfer.setData("DownloadURL", download_url_data);
  e.dataTransfer.effectAllowed = "copy";
}

function createCell(value, text) {
  var cell = document.createElement("td");
  cell.setAttribute("class", "detailsColumn");
  cell.dataset.value = value;
  cell.innerText = text;
  return cell;
}

function start(location) {
  var header = document.getElementById("header");
  header.innerText = header.innerText.replace("LOCATION", location);

  document.getElementById("title").innerText = header.innerText;
}

function onHasParentDirectory() {
  var box = document.getElementById("parentDirLinkBox");
  box.style.display = "block";

  var root = document.location.pathname;
  if (!root.endsWith("/"))
    root += "/";

  var link = document.getElementById("parentDirLink");
  link.href = root + "..";
}

function onListingParsingError() {
  var box = document.getElementById("listingParsingErrorBox");
  box.innerHTML = box.innerHTML.replace("LOCATION", encodeURI(document.location)
      + "?raw");
  box.style.display = "block";
}

function sortTable(column) {
  var theader = document.getElementById("theader");
  var oldOrder = theader.cells[column].dataset.order || '1';
  oldOrder = parseInt(oldOrder, 10)
  var newOrder = 0 - oldOrder;
  theader.cells[column].dataset.order = newOrder;

  var tbody = document.getElementById("tbody");
  var rows = tbody.rows;
  var list = [], i;
  for (i = 0; i < rows.length; i++) {
    list.push(rows[i]);
  }

  list.sort(function(row1, row2) {
    var a = row1.cells[column].dataset.value;
    var b = row2.cells[column].dataset.value;
    if (column) {
      a = parseInt(a, 10);
      b = parseInt(b, 10);
      return a > b ? newOrder : a < b ? oldOrder : 0;
    }

    // Column 0 is text.
    if (a > b)
      return newOrder;
    if (a < b)
      return oldOrder;
    return 0;
  });

  // Appending an existing child again just moves it.
  for (i = 0; i < list.length; i++) {
    tbody.appendChild(list[i]);
  }
}

// Add event handlers to column headers.
function addHandlers(element, column) {
  element.onclick = (e) => sortTable(column);
  element.onkeydown = (e) => {
    if (e.key == 'Enter' || e.key == ' ') {
      sortTable(column);
      e.preventDefault();
    }
  };
}

function onLoad() {
  addHandlers(document.getElementById('nameColumnHeader'), 0);
  addHandlers(document.getElementById('sizeColumnHeader'), 1);
  addHandlers(document.getElementById('dateColumnHeader'), 2);
}

window.addEventListener('DOMContentLoaded', onLoad);
</script>
    

  <div class="col-xl-10 col-lg-9 col-md-8 ml-auto bg-light py-5">
  
 <div id="parentDirLinkBox" style="display:none">
  <a id="parentDirLink" class="icon up">
    <span id="parentDirText">[parent directory]</span>
  </a>
</div>

<table class="table table-stripeds">
  <thead>
    <tr class="header" id="theader">
      <th id="nameColumnHeader" tabindex=0 role="button">Name</th>
      <th id="sizeColumnHeader" class="detailsColumn" tabindex=0 role="button">
        Size
      </th>
      <th id="dateColumnHeader" class="detailsColumn" tabindex=0 role="button">
        Date modified
      </th>
    </tr>
  </thead>
  <tbody id="tbody">
  </tbody>
</table>



  </div>
   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    
  </body>
</html>
<script>// Copyright (c) 2012 The Chromium Authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

/**
 * @fileoverview This file defines a singleton which provides access to all data
 * that is available as soon as the page's resources are loaded (before DOM
 * content has finished loading). This data includes both localized strings and
 * any data that is important to have ready from a very early stage (e.g. things
 * that must be displayed right away).
 *
 * Note that loadTimeData is not guaranteed to be consistent between page
 * refreshes (https://crbug.com/740629) and should not contain values that might
 * change if the page is re-opened later.
 */

// #import {assert} from './assert.m.js';
// #import {parseHtmlSubset} from './parse_html_subset.m.js';

/**
 * @typedef {{
 *   substitutions: (!Array<string>|undefined),
 *   attrs: (!Array<string>|undefined),
 *   tags: (!Array<string>|undefined),
 * }}
 */
/* #export */ let SanitizeInnerHtmlOpts;

// eslint-disable-next-line no-var
/* #export */ /** @type {!LoadTimeData} */ var loadTimeData;

// Expose this type globally as a temporary work around until
// https://github.com/google/closure-compiler/issues/544 is fixed.
/** @constructor */
function LoadTimeData(){}

(function() {
  'use strict';

  LoadTimeData.prototype = {
    /**
     * Sets the backing object.
     *
     * Note that there is no getter for |data_| to discourage abuse of the form:
     *
     *     var value = loadTimeData.data()['key'];
     *
     * @param {Object} value The de-serialized page data.
     */
    set data(value) {
      expect(!this.data_, 'Re-setting data.');
      this.data_ = value;
    },

    /**
     * Returns a JsEvalContext for |data_|.
     * @returns {JsEvalContext}
     */
    createJsEvalContext() {
      return new JsEvalContext(this.data_);
    },

    /**
     * @param {string} id An ID of a value that might exist.
     * @return {boolean} True if |id| is a key in the dictionary.
     */
    valueExists(id) {
      return id in this.data_;
    },

    /**
     * Fetches a value, expecting that it exists.
     * @param {string} id The key that identifies the desired value.
     * @return {*} The corresponding value.
     */
    getValue(id) {
      expect(this.data_, 'No data. Did you remember to include strings.js?');
      const value = this.data_[id];
      expect(typeof value !== 'undefined', 'Could not find value for ' + id);
      return value;
    },

    /**
     * As above, but also makes sure that the value is a string.
     * @param {string} id The key that identifies the desired string.
     * @return {string} The corresponding string value.
     */
    getString(id) {
      const value = this.getValue(id);
      expectIsType(id, value, 'string');
      return /** @type {string} */ (value);
    },

    /**
     * Returns a formatted localized string where $1 to $9 are replaced by the
     * second to the tenth argument.
     * @param {string} id The ID of the string we want.
     * @param {...(string|number)} var_args The extra values to include in the
     *     formatted output.
     * @return {string} The formatted string.
     */
    getStringF(id, var_args) {
      const value = this.getString(id);
      if (!value) {
        return '';
      }

      const args = Array.prototype.slice.call(arguments);
      args[0] = value;
      return this.substituteString.apply(this, args);
    },

    /**
     * Make a string safe for use with with Polymer bindings that are
     * inner-h-t-m-l (or other innerHTML use).
     * @param {string} rawString The unsanitized string.
     * @param {SanitizeInnerHtmlOpts=} opts Optional additional allowed tags and
     *     attributes.
     * @return {string}
     */
    sanitizeInnerHtml(rawString, opts) {
      opts = opts || {};
      return parseHtmlSubset('<b>' + rawString + '</b>', opts.tags, opts.attrs)
          .firstChild.innerHTML;
    },

    /**
     * Returns a formatted localized string where $1 to $9 are replaced by the
     * second to the tenth argument. Any standalone $ signs must be escaped as
     * $$.
     * @param {string} label The label to substitute through.
     *     This is not an resource ID.
     * @param {...(string|number)} var_args The extra values to include in the
     *     formatted output.
     * @return {string} The formatted string.
     */
    substituteString(label, var_args) {
      const varArgs = arguments;
      return label.replace(/\$(.|$|\n)/g, function(m) {
        assert(m.match(/\$[$1-9]/), 'Unescaped $ found in localized string.');
        return m === '$$' ? '$' : varArgs[m[1]];
      });
    },

    /**
     * Returns a formatted string where $1 to $9 are replaced by the second to
     * tenth argument, split apart into a list of pieces describing how the
     * substitution was performed. Any standalone $ signs must be escaped as $$.
     * @param {string} label A localized string to substitute through.
     *     This is not an resource ID.
     * @param {...(string|number)} var_args The extra values to include in the
     *     formatted output.
     * @return {!Array<!{value: string, arg: (null|string)}>} The formatted
     *     string pieces.
     */
    getSubstitutedStringPieces(label, var_args) {
      const varArgs = arguments;
      // Split the string by separately matching all occurrences of $1-9 and of
      // non $1-9 pieces.
      const pieces = (label.match(/(\$[1-9])|(([^$]|\$([^1-9]|$))+)/g) ||
                      []).map(function(p) {
        // Pieces that are not $1-9 should be returned after replacing $$
        // with $.
        if (!p.match(/^\$[1-9]$/)) {
          assert(
              (p.match(/\$/g) || []).length % 2 === 0,
              'Unescaped $ found in localized string.');
          return {value: p.replace(/\$\$/g, '$'), arg: null};
        }

        // Otherwise, return the substitution value.
        return {value: varArgs[p[1]], arg: p};
      });

      return pieces;
    },

    /**
     * As above, but also makes sure that the value is a boolean.
     * @param {string} id The key that identifies the desired boolean.
     * @return {boolean} The corresponding boolean value.
     */
    getBoolean(id) {
      const value = this.getValue(id);
      expectIsType(id, value, 'boolean');
      return /** @type {boolean} */ (value);
    },

    /**
     * As above, but also makes sure that the value is an integer.
     * @param {string} id The key that identifies the desired number.
     * @return {number} The corresponding number value.
     */
    getInteger(id) {
      const value = this.getValue(id);
      expectIsType(id, value, 'number');
      expect(value === Math.floor(value), 'Number isn\'t integer: ' + value);
      return /** @type {number} */ (value);
    },

    /**
     * Override values in loadTimeData with the values found in |replacements|.
     * @param {Object} replacements The dictionary object of keys to replace.
     */
    overrideValues(replacements) {
      expect(
          typeof replacements === 'object',
          'Replacements must be a dictionary object.');
      for (const key in replacements) {
        this.data_[key] = replacements[key];
      }
    }
  };

  /**
   * Checks condition, displays error message if expectation fails.
   * @param {*} condition The condition to check for truthiness.
   * @param {string} message The message to display if the check fails.
   */
  function expect(condition, message) {
    if (!condition) {
      console.error(
          'Unexpected condition on ' + document.location.href + ': ' + message);
    }
  }

  /**
   * Checks that the given value has the given type.
   * @param {string} id The id of the value (only used for error message).
   * @param {*} value The value to check the type on.
   * @param {string} type The type we expect |value| to be.
   */
  function expectIsType(id, value, type) {
    expect(
        typeof value === type, '[' + value + '] (' + id + ') is not a ' + type);
  }

  expect(!loadTimeData, 'should only include this file once');
  loadTimeData = new LoadTimeData;

  // Expose |loadTimeData| directly on |window|. This is only necessary by the
  // auto-generated load_time_data.m.js, since within a JS module the scope is
  // local.
  window.loadTimeData = loadTimeData;
})();
</script><script>loadTimeData.data = {"header":"Index of LOCATION","headerDateModified":"Date modified","headerName":"Name","headerSize":"Size","language":"en","listingParsingErrorBoxText":"The server sent data Microsoft Edge didn't understand. You can \u003Ca href=\"https://permanently-removed.invalid\">report a bug\u003C/a>, and include the \u003Ca href=\"LOCATION\">raw listing\u003C/a>.","parentDirText":"[parent directory]","textdirection":"ltr"};</script><script>start("/");</script>
<script>addRow("text.txt","text.txt",0,15,"15 B",1600263780,"9/16/20, 8:43:00 PM");</script>
<script>addRow("user1","user1",1,0,"0 B",1600263780,"9/16/20, 8:43:00 PM");</script>




