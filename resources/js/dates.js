import { DateTime, Duration } from "luxon";

const DateConstants = {
    TIME_FORMAT: "HH:mm",
    DATE_FORMAT: "yyyy-MM-dd",
    DATETIME_FORMAT: "yyyy-MM-dd HH:mm",
    USER_DATE_FORMAT: "dd MMM yyyy"

}

function currentTimeStr() {
    return DateTime.now().toFormat(DateConstants.TIME_FORMAT);
}

function currentDateStr() {
    return DateTime.now().toFormat(DateConstants.DATE_FORMAT);
}

function currentDateTimeMillis() {
    return DateTime.now().toMillis();
}

function currentDateTimeStr() {
    return DateTime.now().toFormat(DateConstants.DATETIME_FORMAT);
}

function fromISOToDateTimeStr(iso) {
    if (!iso) {
        return null;
    }
    return DateTime.fromISO(iso, { zone: "utc" }).toFormat(DateConstants.DATETIME_FORMAT, { zone: "utc" });
}

function fromISOToDateStr(iso) {
    if (!iso) {
        return null;
    }
    return DateTime.fromISO(iso, { zone: "utc" }).toFormat(DateConstants.DATE_FORMAT, { zone: "utc" });
}

function fromISOToDateUserStr(iso) {
    if (!iso) {
        return null;
    }
    return DateTime.fromISO(iso, { zone: "utc" }).toFormat(DateConstants.USER_DATE_FORMAT, { zone: "utc" });
}

function fromISOToMillis(iso) {
    if (!iso) {
        return null;
    }
    return DateTime.fromISO(iso, { zone: "utc" }).toMillis();
}

function fromStrToMillis(str) {
    if (!str) {
        return null;
    }
    return DateTime.fromFormat(str, DateConstants.DATETIME_FORMAT, { zone: "utc" }).toMillis();
}

function fromStr(str) {
    if (!str) {
        return null;
    }
    return DateTime.fromFormat(str, DateConstants.DATETIME_FORMAT, { zone: "utc" });
}

function fromMillisToDateTimeStr(millis) {
    if (!millis) {
        return null;
    }
    return DateTime.fromMillis(millis).setZone("utc").toFormat(DateConstants.DATETIME_FORMAT, { zone: "utc" });
}

function fromMillisToTimeStr(millis) {
    if (!millis) {
        return null;
    }
    return DateTime.fromMillis(millis).setZone("utc").toFormat(DateConstants.TIME_FORMAT, { zone: "utc" });
}

function fromISOTimeToMillis(iso) {
    if (!iso) {
        return null;
    }
    return Duration.fromISO(iso, { zone: "utc" }).toMillis();
}

function createToMillis({ year, month, day, hour, minute, second, millisecond }) {
    return DateTime.utc(year, month, day, hour, minute, second, millisecond).toMillis();
}

const DateFunctions = {
    createToMillis,
    currentTimeStr,
    currentDateStr,
    currentDateTimeMillis,
    currentDateTimeStr,
    fromISOToDateTimeStr,
    fromISOToDateStr,
    fromISOToDateUserStr,
    fromISOToMillis,
    fromStrToMillis,
    fromStr,
    fromISOTimeToMillis,
    fromMillisToDateTimeStr,
    fromMillisToTimeStr,
}

export {
    DateConstants,
    DateFunctions,
    DateTime
};