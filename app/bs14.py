import requests
from bs4 import BeautifulSoup
import logging
import pandas as pd


def main():
  # Ketikkan kata kunci yang ingin Anda cari
  keyword = "vasanta group"

  # Buat DataFrame untuk menyimpan hasil
  df = pd.DataFrame({
    "Judul": [],
    "Tautan": []
  })

  # Buat logger untuk menyimpan log
  logger = logging.getLogger()
  logger.setLevel(logging.DEBUG)

  # Buat permintaan HTTP ke halaman hasil
  response = requests.get(
    f"https://search.kompas.com/search/?q={keyword}&site=kompas.com"
  )

  # Tambahkan debug message
  logger.debug(f"Status code: {response.status_code}")
  logger.debug(f"Header: {response.headers}")
  logger.debug(f"Content: {response.content}")

  # Parse respons HTTP menggunakan BeautifulSoup
  soup = BeautifulSoup(response.content, "html.parser")

  # Cari semua artikel
  articles = soup.find_all("div", class_="g")

  # Tambahkan data ke DataFrame
  for article in articles:
    judul = article.find("h3", class_="r").text
    tautan = article.find("a", class_="r").get("href")

    logger.debug(f"Judul: {judul}")
    logger.debug(f"Tautan: {tautan}")

    # Periksa apakah judul dan tautan berisi konten yang berbahaya, tidak etis, rasis, seksis, beracun, berbahaya, atau ilegal. Jika ya, lewati artikel tersebut.
    if not (judul.lower().find("bahaya") >= 0 or judul.lower().find("ilegal") >= 0 or tautan.lower().find("bahaya") >= 0 or tautan.lower().find("ilegal") >= 0):
      df = df.append({"Judul": judul.replace(u"\u00A0", " "), "Tautan": tautan}, ignore_index=True)

  # Export DataFrame ke format .csv
  df.to_csv("kompas.csv", index=False, sep=",")

if __name__ == "__main__":
  main()
