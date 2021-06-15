import { DateTime, Settings } from "luxon";

Settings.defaultZoneName = "utc";

const DateConstants = {
    TIME_FORMAT: "HH:mm",
    DATE_FORMAT: "yyyy-MM-dd",
    DATETIME_FORMAT: "yyyy-MM-dd HH:mm"
}

const DateFunctions = {
    currentTimeStr: () => DateTime.now().toFormat(DateConstants.TIME_FORMAT, {  zone: "utc"}),
    currentDateStr: () => DateTime.now().toFormat(DateConstants.DATE_FORMAT, {  zone: "utc"}),
    currentDateTimeMillis: () => DateTime.now().toMillis(),
    currentDateTimeStr: () => DateTime.now().toFormat(DateConstants.DATETIME_FORMAT, {  zone: "utc"}),
    fromISOToDateTimeStr: (iso) => DateTime.fromISO(iso, {  zone: "utc"}).toFormat(DateConstants.DATETIME_FORMAT, {  zone: "utc"}),
    fromISOToDateStr: (iso) => DateTime.fromISO(iso, {  zone: "utc"}).toFormat(DateConstants.DATE_FORMAT, {  zone: "utc"}),
    fromISOToMillis: (iso) => DateTime.fromISO(iso, {  zone: "utc"}).toMillis(),
    fromMillisToDateTimeStr: (millis) => DateTime.fromMillis(millis).setZone("utc").toFormat(DateConstants.DATETIME_FORMAT, {  zone: "utc"}),
}

export {
    DateFunctions
};