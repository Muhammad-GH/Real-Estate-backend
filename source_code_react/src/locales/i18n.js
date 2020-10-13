import i18n from "i18next";
import { initReactI18next } from "react-i18next";
import LanguageDetector from "i18next-browser-languagedetector";
import { langConfig } from "../helper/helper";
import en from "./en/common.json";
import fi from "./fi/common.json";

// the translations
// (tip move them in a JSON file and import them)
const resources = {
  en,
  fi,
};

// const lng = localStorage.getItem('_lng')
i18n
  .use(LanguageDetector)
  .use(initReactI18next) // passes i18n down to react-i18next
  .init({
    resources,
    lng: localStorage.getItem("_lng"),
    fallbackLng: "fi",

    // keySeparator: false, // we do not use keys in form messages.welcome

    interpolation: {
      escapeValue: false, // react already safes from xss
    },
  });

export default i18n;
