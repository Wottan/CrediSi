import { DateTime, Settings, Duration } from "luxon";

Settings.defaultZoneName = "utc";

const DateConstants = {
    TIME_FORMAT: "HH:mm",
    DATE_FORMAT: "yyyy-MM-dd",
    DATETIME_FORMAT: "yyyy-MM-dd HH:mm"
}

function currentTimeStr() {
    return DateTime.now().toFormat(DateConstants.TIME_FORMAT, { zone: "utc" });
}

function currentDateStr() {
    return DateTime.now().toFormat(DateConstants.DATE_FORMAT, { zone: "utc" });
}

function currentDateTimeMillis() {
    return DateTime.now().toMillis();
}

function currentDateTimeStr() {
    return DateTime.now().toFormat(DateConstants.DATETIME_FORMAT, { zone: "utc" });
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

function fromISOToMillis(iso) {
    if (!iso) {
        return null;
    }
    return DateTime.fromISO(iso, { zone: "utc" }).toMillis();
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

function hourDifferenceFromMillis(start, end) {
    if (!start || !end) {
        return null;
    }
    return Duration.fromMillis(end).toObject().hours - Duration.fromMillis(start).toObject().hours;
}

const DateFunctions = {
    currentTimeStr,
    currentDateStr,
    currentDateTimeMillis,
    currentDateTimeStr,
    fromISOToDateTimeStr,
    fromISOToDateStr,
    fromISOToMillis,
    fromISOTimeToMillis,
    fromMillisToDateTimeStr,
    fromMillisToTimeStr,
    hourDifferenceFromMillis,
}

export {
    DateConstants,
    DateFunctions
};