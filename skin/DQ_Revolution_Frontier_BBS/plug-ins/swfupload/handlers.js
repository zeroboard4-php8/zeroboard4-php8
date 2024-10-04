function fileQueued(file) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("Pending...");
		progress.toggleCancel(true, this);

	} catch (ex) {
		this.debug(ex);
	}

}

function fileQueueError(file, errorCode, message) {
	try {
		if (errorCode === SWFUpload.QUEUE_ERROR.QUEUE_LIMIT_EXCEEDED) {
			alert("You have attempted to queue too many files.\n" + (message === 0 ? "You have reached the upload limit." : "You may select " + (message > 1 ? "up to " + message + " files." : "one file.")));
			return;
		}

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
			progress.setStatus("File is too big.");
			this.debug("Error Code: File too big, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
			progress.setStatus("Cannot upload Zero Byte files.");
			this.debug("Error Code: Zero byte file, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
			progress.setStatus("Invalid File Type.");
			this.debug("Error Code: Invalid File Type, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		default:
			if (file !== null) {
				progress.setStatus("Unhandled Error");
			}
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function fileDialogComplete(numFilesSelected, numFilesQueued)
{
    var length = swu.uploadFilesVirtName.length;
    if(swfu.getSetting('file_queue_limit') > 0 && (length  + numFilesQueued) > swfu.getSetting('file_queue_limit')) {
      alert('possible number of files is up to '+swfu.getSetting('file_queue_limit'));
      swfu.cancelQueue();
      if(length >= swfu.getSetting('file_queue_limit')) {
        swfu.setButtonDisabled(true);
      }
      return false;
    }

    try {
		if (numFilesSelected > 0) {
			//document.getElementById(this.customSettings.cancelButtonId).disabled = false;
		}
		
		this.startUpload();
	} catch (ex)  {
        this.debug(ex);
	}
}

function uploadStart(file) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setStatus("Uploading...");
		progress.toggleCancel(true, this);
	}
	catch (ex) {}
	
	return true;
}

function uploadProgress(file, bytesLoaded, bytesTotal) {
	try {
		var percent = Math.ceil((bytesLoaded / bytesTotal) * 100);

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setProgress(percent);
		progress.setStatus("Uploading...");
	} catch (ex) {
		this.debug(ex);
	}
}

function uploadSuccess(file, serverData) {
	try {
        file.name = file.name.replace(",","_");

		var img = addImage(rv.SS.zbURL+rv.SS.zbSkin_dir+"/plug-ins/swfupload/thumbnail.php?file=" + serverData,file.name);
        var fileVirt = document.zbform.file_virtName;
        var fileReal = document.zbform.file_realName;
        var descript = document.zbform.file_descript;
        var length = swu.uploadFilesVirtName.length;
        
        swu.uploadFilesVirtName[length] = serverData;
        swu.uploadFilesRealName[length] = file.name;
        swu.addThumbTools(img.parentNode,serverData);

		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setComplete();
		progress.setStatus("Complete.");
		progress.toggleCancel(false);

        fileVirt.value = swu.uploadFilesVirtName.join();
        fileReal.value = swu.uploadFilesRealName.join();

        dragsort.makeListSortable(document.getElementById("swuThumbnails"));
    } catch (ex) {
		this.debug(ex);
	}
}

function uploadError(file, errorCode, message) {
	try {
		var progress = new FileProgress(file, this.customSettings.progressTarget);
		progress.setError();
		progress.toggleCancel(false);

		switch (errorCode) {
		case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
			progress.setStatus("Upload Error: " + message);
			this.debug("Error Code: HTTP Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_FAILED:
			progress.setStatus("Upload Failed.");
			this.debug("Error Code: Upload Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.IO_ERROR:
			progress.setStatus("Server (IO) Error");
			this.debug("Error Code: IO Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
			progress.setStatus("Security Error");
			this.debug("Error Code: Security Error, File name: " + file.name + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
			progress.setStatus("Upload limit exceeded.");
			this.debug("Error Code: Upload Limit Exceeded, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_VALIDATION_FAILED:
			progress.setStatus("Failed Validation.  Upload skipped.");
			this.debug("Error Code: File Validation Failed, File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
			if (this.getStats().files_queued === 0) {
				//document.getElementById(this.customSettings.cancelButtonId).disabled = true;
			}
			progress.setStatus("Cancelled");
			progress.setCancelled();
			break;
		case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
			progress.setStatus("Stopped");
			break;
		default:
			progress.setStatus("Unhandled Error: " + errorCode);
			this.debug("Error Code: " + errorCode + ", File name: " + file.name + ", File size: " + file.size + ", Message: " + message);
			break;
		}
	} catch (ex) {
        this.debug(ex);
    }
}

function uploadComplete(file) {
	if (this.getStats().files_queued === 0) {
		//document.getElementById(this.customSettings.cancelButtonId).disabled = true;
	}
}

function queueComplete(numFilesUploaded) {
	var status = document.getElementById("divStatus");
	status.innerHTML = numFilesUploaded + " file" + (numFilesUploaded === 1 ? "" : "s") + " uploaded.";
}

function addImage(src,filename) {
	var newImg = document.createElement("img");
	var newDiv = document.createElement("li");
    newImg.style.margin = "5px";

	document.getElementById("swuThumbnails").appendChild(newDiv);
	newDiv.className = "swuThumbnailFrame";
	newDiv.appendChild(newImg);
	if (newImg.filters) {
		try {
			newImg.filters.item("DXImageTransform.Microsoft.Alpha").opacity = 0;
            alert();
		} catch (e) {
			newImg.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + 0 + ')';
		}
	} else {
		newImg.style.opacity = 0;
	}

	newImg.onload = function () {
		rv.fadeIn(newImg, 0);
	};
	newImg.src = src+'&realname='+filename;
	newImg.title = filename;
    //document.zbform.memo.value = newImg.src;
    return newImg;
}

var swu = {
  zbWriteMode : document.zbform ? document.zbform.mode.value : '',
  removeElement: new Object,
  uploadFilesVirtName : new Array,
  uploadFilesRealName : new Array,
  uploadFilesDescript : new Array,
  mouseoverElement : new Object,
  commentPosition: 0,

  delThumbnail : function(filename,removeEl) {
    var url = rv.SS.zbSkin_dir + "/plug-ins/swfupload/delthumbnail.php?zbid="+rv.SS.id+"&no="+rv.SS.no+"&filename="+filename.replace('?','&')+"&mode="+swu.zbWriteMode;
    var pos = rv.arraySearch(swu.uploadFilesVirtName,filename);
    //zbform.memo.value = url;

    //rv.xmlHttp.open("GET", url, true);
    //rv.xmlHttp.onreadystatechange = this.removeFile;
    //rv.xmlHttp.send(null);
    this.removeElement = removeEl.fileID;

    removeEl.parentNode.removeChild(removeEl);
    swu.uploadFilesVirtName.splice(pos,1);
    swu.uploadFilesRealName.splice(pos,1);
    swu.uploadFilesDescript.splice(pos,1);

    var fileVirt = document.zbform.file_virtName;
    var fileReal = document.zbform.file_realName;
    var descript = document.zbform.file_descript;
    fileVirt.value = swu.uploadFilesVirtName.join();
    fileReal.value = swu.uploadFilesRealName.join();
    descript.value = swu.uploadFilesDescript.join("||");
    dragsort.makeListSortable(document.getElementById("swuThumbnails"));

    var length = swu.uploadFilesVirtName.length;
    if(swfu.getSetting('file_queue_limit') > 0) {
      if(length >= swfu.getSetting('file_queue_limit')) {
        swfu.setButtonDisabled(true);
      } else {
        swfu.setButtonDisabled(false);
      }
    }
  },
  removeFile : function() {
    if (rv.xmlHttp.readyState == 4) {
      var response = rv.xmlHttp.responseText;
      alert(response);
    }
  },
  addFiles : function() {
    if(!document.zbform.file_virtName.value) return;
    var fileVirt = swu.uploadFilesVirtName = document.zbform.file_virtName.value.split(",");
    var fileReal = swu.uploadFilesRealName = document.zbform.file_realName.value.split(",");
    var descript = swu.uploadFilesDescript = document.zbform.file_descript.value.split("||");
    var img = new Image;

    for(i=0; i<fileVirt.length; i++) {
        if(fileVirt[i] != "") {
          img = addImage(rv.SS.zbURL+rv.SS.zbSkin_dir+"/plug-ins/swfupload/thumbnail.php?file="+fileVirt[i].replace('?','&'),fileReal[i]);
          swu.addThumbTools(img.parentNode,fileVirt[i]);
          //document.zbform.memo.value = img.src;
        }
    }
  },
  addThumbTools : function (div,fileName,e) 
  { // Tools Add
      var cmtDiv  = document.getElementById("swuCommentInputFrame");
      var newDiv2 = document.createElement("div");
      var btnDel  = document.createElement("span");
      var btnCmt  = document.createElement("span");
      var pos = rv.arraySearch(swu.uploadFilesVirtName,fileName);

      newDiv2.className = "swfuThumbnailTools";
      div.filename = fileName;

      btnDel.innerHTML  = "Del";
      btnCmt.innerHTML  = "Comment";

      if(swu.aTagGrant | swu.imgTagGrant) {
        var btnAdd  = document.createElement("span");
        var separat = document.createElement("span");
        btnAdd.innerHTML  = "Insert";
        separat.innerHTML = "|";

        btnDel.style.cursor = "pointer";
        btnAdd.style.cursor = "pointer";
        btnCmt.style.cursor = "pointer";

        btnAdd.className = "swuBtnThumbnail";
        btnAdd.onclick   = function()
        {
            var edCheck = document.getElementById('use_weditor');
            temp_dir = fileName.match('/|revol_getimg\.php') ? '' : "revol_getimg.php?id="+rv.SS.id+"&file_id=";

            if(!edCheck || !edCheck.checked) 
            {
                document.zbform.memo.focus();
                if(!isIE) 
                {
                    mEl = document.zbform.memo;
                    st1 = mEl.value.substring(0,mEl.selectionStart);
                    st2 = mEl.value.substring(mEl.selectionStart,mEl.selectionEnd);
                    st3 = mEl.value.substring(mEl.selectionEnd);
                }
                else {
                  cRange = document.selection.createRange();
                }

                if(swu.uploadFilesRealName[pos].toLowerCase().match("\.jpe?g$|\.gif$|\.bmp$|\.png$")) {
                  spt = '<img src="'+rv.SS.zbURL+temp_dir+fileName+'" />\n';
                  if(!isIE) {
                    mEl.value = st1+spt+st2+st3;
                  }
                  else cRange.text = spt;
                } else {
                  spt = '<a href="'+rv.SS.zbURL+'revol_download.php?id='+rv.SS.id+'&no='+rv.SS.no+'&filenum='+(pos+1)+'">'+swu.uploadFilesRealName[pos]+'</a>\n';
                  if(document.getSelection) {
                    mEl.value = st1+spt+st2+st3;
                  }
                  else cRange.text = spt;
                }

                if(document.zbform.use_html && !document.zbform.use_html.checked) {
                  document.zbform.use_html.checked = true;
                  check_use_html(document.zbform.use_html);
                }
            } else {
                var oEditor ;
                if (typeof(FCKeditorAPI) != 'undefined') oEditor = FCKeditorAPI.GetInstance('memo') ;
                if(oEditor && swu.uploadFilesRealName[pos].toLowerCase().match("\.jpe?g$|\.gif$|\.bmp$|\.png$")) {
                   oEditor.InsertHtml('<img src="'+rv.SS.zbURL+temp_dir+fileName+'" /><br />\n');
                } else {
                   oEditor.InsertHtml('<a href="'+rv.SS.zbURL+'revol_download.php?id='+rv.SS.id+'&no='+rv.SS.no+'&filenum='+(pos+1)+'">'+swu.uploadFilesRealName[pos]+'</a>\n');
                }
            }
          }
        }
        btnDel.className = btnCmt.className = "swuBtnThumbnail";
        btnDel.onclick   = function(){ swu.delThumbnail(fileName,div) };
        btnCmt.onclick   = function(){
          swu.commentPosition = rv.arraySearch(swu.uploadFilesVirtName,fileName);
          descript = document.getElementById('swu_descript')
          descript.value = swu.uploadFilesDescript[swu.commentPosition] ? swu.uploadFilesDescript[swu.commentPosition] : '';

          var p  = rv.getPosition(newDiv2);
          var ps = rv.getPageSize();
          if(p.x+500 > ps.width) p.x = ps.width-500+ps.scrollLeft;

          cmtDiv.style.top  = p.y + "px";
          cmtDiv.style.left = p.x + "px";
          cmtDiv.style.display = "block";
          //cmtDiv.style.z-index = 99;
          descript.focus();
        };

      div.appendChild(newDiv2);

      newDiv2.appendChild(btnCmt);
      newDiv2.appendChild(document.createElement("br"));
      if(swu.aTagGrant | swu.imgTagGrant) {
          newDiv2.appendChild(btnAdd);
          newDiv2.appendChild(separat);
      }
      newDiv2.appendChild(btnDel);

      newDiv2.onmouseover = function() {
          swu.mouseoverElement = newDiv2;
      }
      div.firstChild.onmouseover = function () {
          var p = rv.getPosition(div);
          if(swu.mouseoverElement != newDiv2) {
            if(swu.mouseoverElement.nodeName == "DIV") swu.mouseoverElement.style.display = "none";
            swu.mouseoverElement = div.firstChild;
            rv.setOpacity(newDiv2,0);
            newDiv2.style.display = "block";
            rv.fadeIn(newDiv2,0,60);
          }
      };
      div.firstChild.onmouseout = function () {
        window.setTimeout(function(){
          if(swu.mouseoverElement != newDiv2) newDiv2.style.display = "none";
        },100);
      }
  }
};
