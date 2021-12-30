const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
console.log('Timezone is: ' + tz);
document.cookie = "timezone=" + tz


location.reload();