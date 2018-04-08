function tree(selectors, data) {
  /** @type {Object} */
  this.tm2 = data;
  /** @type {(Array|number)} */
  this.tm3 = selectors;
  this.tm4 = this;
  /** @type {Array} */
  this.tm5 = [];
  /** @type {null} */
  this.tm6 = null;
  /** @type {number} */
  this.tm7 = -1;
  /** @type {Image} */
  var value = new Image;
  /** @type {Image} */
  var row = new Image;
  value.src = data["icon_e"];
  row.src = data["icon_l"];
  /** @type {Image} */
  data["im_e"] = value;
  /** @type {Image} */
  data["im_l"] = row;
  /** @type {number} */
  var s = 0;
  for (;s < 64;s++) {
    if (data["icon_" + s]) {
      /** @type {Image} */
      var element = new Image;
      /** @type {Image} */
      data["im_" + s] = element;
      element.src = data["icon_" + s];
    }
  }
  /**
   * @param {?} key
   * @return {undefined}
   */
  this.tmB = function(key) {
    var label = this.tm5[key];
    label.tmE(label.tmF);
  };
  /**
   * @param {boolean} desiredNonCommentArgIndex
   * @return {?}
   */
  this.tmG = function(desiredNonCommentArgIndex) {
    return this.tm5[desiredNonCommentArgIndex].tmG();
  };
  /**
   * @param {?} timeoutKey
   * @return {undefined}
   */
  this.tmH = function(timeoutKey) {
    this.tm5[timeoutKey].tmI(true);
  };
  /**
   * @param {?} timeoutKey
   * @return {undefined}
   */
  this.tmJ = function(timeoutKey) {
    this.tm5[timeoutKey].tmI();
  };
  /** @type {Array} */
  this.tmK = [];
  /** @type {number} */
  s = 0;
  for (;s < selectors.length;s++) {
    new tmL(this, s);
  }
  this.tmC = trees.length;
  trees[this.tmC] = this;
  /** @type {number} */
  s = 0;
  for (;s < this.tmK.length;s++) {
    document.write(this.tmK[s].tmM());
    this.tmK[s].tmE();
  }
}
/**
 * @param {?} self
 * @param {number} timeoutKey
 * @return {undefined}
 */
function tmL(self, timeoutKey) {
  this.tm7 = self.tm7 + 1;
  this.tm3 = self.tm3[timeoutKey + (this.tm7 ? 2 : 0)];
  if (!this.tm3) {
    return;
  }
  this.tm4 = self.tm4;
  this.tmN = self;
  /** @type {number} */
  this.tmO = timeoutKey;
  /** @type {boolean} */
  this.tmF = !this.tm7;
  this.tmC = this.tm4.tm5.length;
  this.tm4.tm5[this.tmC] = this;
  self.tmK[timeoutKey] = this;
  /** @type {Array} */
  this.tmK = [];
  /** @type {number} */
  var i = 0;
  for (;i < this.tm3.length - 2;i++) {
    new tmL(this, i);
  }
  /** @type {function (boolean): ?} */
  this.tmP = tmQ;
  /** @type {function (boolean): undefined} */
  this.tmE = tmR;
  /** @type {function (boolean): ?} */
  this.tmG = tmS;
  /** @type {function (): ?} */
  this.tmM = tmT;
  /** @type {function (boolean): undefined} */
  this.tmI = tmU;
  /**
   * @return {?}
   */
  this.tmV = function() {
    return this.tmO == this.tmN.tmK.length - 1;
  };
}
/**
 * @param {boolean} show
 * @return {undefined}
 */
function tmR(show) {
  var elem = tmY("i_div" + this.tm4.tmC + "_" + this.tmC);
  if (!elem) {
    return;
  }
  if (!elem.innerHTML) {
    /** @type {Array} */
    var handles = [];
    /** @type {number} */
    var j = 0;
    for (;j < this.tmK.length;j++) {
      handles[j] = this.tmK[j].tmM();
    }
    /** @type {string} */
    elem.innerHTML = handles.join("");
  }
  /** @type {string} */
  elem.style.display = show ? "none" : "block";
  /** @type {boolean} */
  this.tmF = !show;
  var g = document.images["j_img" + this.tm4.tmC + "_" + this.tmC];
  var script = document.images["i_img" + this.tm4.tmC + "_" + this.tmC];
  if (g) {
    g.src = this.tmP(true);
  }
  if (script) {
    script.src = this.tmP();
  }
  this.tmI();
}
/**
 * @param {boolean} dataAndEvents
 * @return {?}
 */
function tmS(dataAndEvents) {
  if (!dataAndEvents) {
    var tm6 = this.tm4.tm6;
    this.tm4.tm6 = this;
    if (tm6) {
      tm6.tmG(true);
    }
  }
  var g = document.images["i_img" + this.tm4.tmC + "_" + this.tmC];
  if (g) {
    g.src = this.tmP();
  }
  /** @type {string} */
  tmY("i_txt" + this.tm4.tmC + "_" + this.tmC).style.fontWeight = dataAndEvents ? "normal" : "bold";
  this.tmI();
  return Boolean(this.tm3[1]);
}
/**
 * @param {boolean} dataAndEvents
 * @return {undefined}
 */
function tmU(dataAndEvents) {
  window.setTimeout('window.status="' + (dataAndEvents ? "" : this.tm3[0] + (this.tm3[1] ? " (" + this.tm3[1] + ")" : "")) + '"', 10);
}
/**
 * @return {?}
 */
function tmT() {
  /** @type {Array} */
  var map = [];
  var tapElement = this.tmN;
  var objUid = this.tm7;
  for (;objUid > 1;objUid--) {
    /** @type {string} */
    map[objUid] = '<img src="' + this.tm4.tm2[tapElement.tmV() ? "icon_e" : "icon_l"] + '" border="0" align="absbottom">';
    tapElement = tapElement.tmN;
  }
  return'<table cellpadding="0" cellspacing="0" border="0"><tr><td nowrap>' + (this.tm7 ? map.join("") + (this.tmK.length ? '<a href="javascript: trees[' + this.tm4.tmC + "].tmB(" + this.tmC + ')" onmouseover="trees[' + this.tm4.tmC + "].tmJ(" + this.tmC + ')" onmouseout="trees[' + this.tm4.tmC + "].tmH(" + this.tmC + ')"><img src="' + this.tmP(true) + '" border="0" align="absbottom" name="j_img' + this.tm4.tmC + "_" + this.tmC + '"></a>' : '<img src="' + this.tmP(true) + '" border="0" align="absbottom">') : 
  "") + '<a href="' + this.tm3[1] + '" target="' + this.tm4.tm2["target"] + '" onclick="return trees[' + this.tm4.tmC + "].tmG(" + this.tmC + ')" ondblclick="trees[' + this.tm4.tmC + "].tmB(" + this.tmC + ')" onmouseover="trees[' + this.tm4.tmC + "].tmJ(" + this.tmC + ')" onmouseout="trees[' + this.tm4.tmC + "].tmH(" + this.tmC + ')" class="t' + this.tm4.tmC + 'i" id="i_txt' + this.tm4.tmC + "_" + this.tmC + '"><img src="' + this.tmP() + '" border="0" align="absbottom" name="i_img' + this.tm4.tmC + 
  "_" + this.tmC + '" class="t' + this.tm4.tmC + 'im">' + this.tm3[0] + "</a></td></tr></table>" + (this.tmK.length ? '<div id="i_div' + this.tm4.tmC + "_" + this.tmC + '" style="display:none"></div>' : "");
}
/**
 * @param {boolean} dataAndEvents
 * @return {?}
 */
function tmQ(dataAndEvents) {
  return this.tm4.tm2["icon_" + ((this.tm7 ? 0 : 32) + (this.tmK.length ? 16 : 0) + (this.tmK.length && this.tmF ? 8 : 0) + (!dataAndEvents && this.tm4.tm6 == this ? 4 : 0) + (dataAndEvents ? 2 : 0) + (dataAndEvents && this.tmV() ? 1 : 0))];
}
/** @type {Array} */
var trees = [];
/** @type {function (string): ?} */
tmY = document.all ? function(id) {
  return document.all[id];
} : function(opt_id) {
  return document.getElementById(opt_id);
};