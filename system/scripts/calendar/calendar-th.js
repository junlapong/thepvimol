// ** I18N

// Calendar Thai language
// Author: Junlapong Leecharoen, <devspy@hotmail.com>
// Encoding: any
// Distributed under the same terms as the calendar itself.

// For translators: please use UTF-8 if possible.  We strongly believe that
// Unicode is the answer to a real internationalized world.  Also please
// include your contact information in the header, as can be seen above.

// full day names
Zapatec.Calendar._DN = new Array
("อาทิตย์",
 "จันทร์",
 "อังคาร",
 "พุธ",
 "พฤหัสบดี",
 "ศุกร์",
 "เสาร์",
 "อาทิตย์");

// Please note that the following array of short day names (and the same goes
// for short month names, _SMN) isn't absolutely necessary.  We give it here
// for exemplification on how one can customize the short day names, but if
// they are simply the first N letters of the full name you can simply say:
//
//   Zapatec.Calendar._SDN_len = N; // short day name length
//   Zapatec.Calendar._SMN_len = N; // short month name length
//
// If N = 3 then this is not needed either since we assume a value of 3 if not
// present, to be compatible with translation files that were written before
// this feature.

// short day names
Zapatec.Calendar._SDN = new Array
("อา.",
 "จ.",
 "อ.",
 "พ.",
 "พฤ.",
 "ศ.",
 "ส.",
 "อา.");

// First day of the week. "0" means display Sunday first, "1" means display
// Monday first, etc.
Zapatec.Calendar._FD = 0;

// full month names
Zapatec.Calendar._MN = new Array
("มกราคม",
 "กุมภาพันธ์",
 "มีนาคม",
 "เมษายน",
 "พฤษภาคม",
 "มิถุนายน",
 "กรกฎาคม",
 "สิงหาคม",
 "กันยายน",
 "ตุลาคม",
 "พฤศจิกายน",
 "ธันวาคม");

// short month names
Zapatec.Calendar._SMN = new Array
("ม.ค.",
 "ก.พ.",
 "มี.ค.",
 "เม.ย.",
 "พ.ค.",
 "มิ.ย.",
 "ก.ค.",
 "ส.ค.",
 "ก.ย.",
 "ต.ค.",
 "พ.ย.",
 "ธ.ค.");

// tooltips
Zapatec.Calendar._TT_en = Zapatec.Calendar._TT = {};
Zapatec.Calendar._TT["INFO"] = "วิธีใช้ปฎิทิน";

Zapatec.Calendar._TT["ABOUT"] =
"การเลือกวันที่:\n" +
"- ใช้ปุ่ม \xab, \xbb เพื่อเลือกปี\n" +
"- ใช้ปุ่ม " + String.fromCharCode(0x2039) + ", " + String.fromCharCode(0x203a) + " เพื่อเลือกเดือน\n" +
"- กดค้างที่ปุ่มเพื่อเลือกจากตัวเลือก";
Zapatec.Calendar._TT["ABOUT_TIME"] = "\n\n" +
"การเลือกเวลา:\n" +
"- กดที่ตัวเลือกเวลาเพื่อเพิ่มเวลา\n" +
"- หรือ Shift-click เพื่อลดเวลา\n" +
"- หรือ Click แล้วลากเพื่อเปลี่ยนเวลาอย่างรวดเร็ว";

Zapatec.Calendar._TT["PREV_YEAR"] = "ปีก่อน";
Zapatec.Calendar._TT["PREV_MONTH"] = "เดือนก่อน";
Zapatec.Calendar._TT["GO_TODAY"] = "ไปยังวันนี้";
Zapatec.Calendar._TT["NEXT_MONTH"] = "เดือนถัดไป";
Zapatec.Calendar._TT["NEXT_YEAR"] = "ปีถัดไป";
Zapatec.Calendar._TT["SEL_DATE"] = "เลือกวัน";
Zapatec.Calendar._TT["DRAG_TO_MOVE"] = "ลากเพื่อย้าย";
Zapatec.Calendar._TT["PART_TODAY"] = " (วันนี้)";

// the following is to inform that "%s" is to be the first day of week
// %s will be replaced with the day name.
Zapatec.Calendar._TT["DAY_FIRST"] = "แสดง %s อันดับแรก";

// This may be locale-dependent.  It specifies the week-end days, as an array
// of comma-separated numbers.  The numbers are from 0 to 6: 0 means Sunday, 1
// means Monday, etc.
Zapatec.Calendar._TT["WEEKEND"] = "0,6";

Zapatec.Calendar._TT["CLOSE"] = "ปิด";
Zapatec.Calendar._TT["TODAY"] = "วันนี้";
Zapatec.Calendar._TT["TIME_PART"] = "(Shift-)Click หรือลากเพื่อนเปลี่ยนค่า";

// date formats
Zapatec.Calendar._TT["DEF_DATE_FORMAT"] = "%Y/%m/%d";
Zapatec.Calendar._TT["TT_DATE_FORMAT"] = "%e %B %Y";

Zapatec.Calendar._TT["WK"] = "สด.";
Zapatec.Calendar._TT["TIME"] = "เวลา:";

Zapatec.Calendar._TT["E_RANGE"] = "เกินช่วงที่เลือกได้";

/* Preserve data */
	if(Zapatec.Calendar._DN) Zapatec.Calendar._TT._DN = Zapatec.Calendar._DN;
	if(Zapatec.Calendar._SDN) Zapatec.Calendar._TT._SDN = Zapatec.Calendar._SDN;
	if(Zapatec.Calendar._SDN_len) Zapatec.Calendar._TT._SDN_len = Zapatec.Calendar._SDN_len;
	if(Zapatec.Calendar._MN) Zapatec.Calendar._TT._MN = Zapatec.Calendar._MN;
	if(Zapatec.Calendar._SMN) Zapatec.Calendar._TT._SMN = Zapatec.Calendar._SMN;
	if(Zapatec.Calendar._SMN_len) Zapatec.Calendar._TT._SMN_len = Zapatec.Calendar._SMN_len;
	Zapatec.Calendar._DN = Zapatec.Calendar._SDN = Zapatec.Calendar._SDN_len = Zapatec.Calendar._MN = Zapatec.Calendar._SMN = Zapatec.Calendar._SMN_len = null
