
class UrlCheck {
    try(link){
        try {
            new URL(link)
            return true
        } catch (error) {
            return false;
        }
    }
}


export const URLCheckService = new UrlCheck()