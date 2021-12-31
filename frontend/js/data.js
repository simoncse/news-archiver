const axios = require('axios');

//Change the endpoint if needed
const API_ENDPOINT = "http://flashbacknews.tk/api";

// const sleep = ms => new Promise(
//     resolve => setTimeout(resolve, ms));


export async function getEntriesByDate(dateString) {
    let data;

    try {
        const resp = await axios.get(API_ENDPOINT, {
            params: { date: dateString }
        })
        data = resp.data
        // await sleep(3000);
    } catch (err) {
        console.error(err);
        data = false;

    }

    return data;
}
