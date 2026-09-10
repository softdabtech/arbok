#!/usr/bin/env python3
import html
import json
import math
import os
import re
import textwrap
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
DATA = ROOT / "build/qa/live-technologies.json"
OUT = ROOT / "wp-content/themes/arbok-deeptech/assets/images/technology-visuals"

SECTOR_THEMES = {
    "sector-a": {
        "label": "Water Desalination & Treatment",
        "colors": ("#042a4d", "#026d9a", "#49bfda"),
        "icon": "M42 8 C25 33 14 49 14 65 c0 22 17 39 38 39s38-17 38-39C90 49 75 32 42 8Z M31 70c8 10 25 11 36 0",
    },
    "sector-b": {
        "label": "Waste Management",
        "colors": ("#07311f", "#0d6c4f", "#44b88d"),
        "icon": "M24 30h56M31 30l5 58h32l5-58M39 22h26l4 8H35zM44 42v34M60 42v34",
    },
    "sector-c": {
        "label": "Energy Production",
        "colors": ("#182642", "#014387", "#6fb7ff"),
        "icon": "M55 6 24 58h25l-7 50 38-61H56z",
    },
    "sector-d": {
        "label": "Air & Climate Control",
        "colors": ("#11283a", "#31627f", "#a8dcef"),
        "icon": "M16 45c18-19 41-18 56 0 11 13 26 13 36 1M20 68c19-13 38-12 52 1 11 10 24 10 34 0M31 90c13-7 27-7 40 0",
    },
    "sector-e": {
        "label": "Oil Spill Cleanup",
        "colors": ("#111827", "#17505f", "#29a68a"),
        "icon": "M52 12c19 20 32 39 32 57 0 19-14 35-32 35S20 88 20 69c0-18 13-37 32-57zM27 83c17 8 33 8 50 0",
    },
    "sector-f": {
        "label": "Fertilizers",
        "colors": ("#10291d", "#2f7555", "#9ccf74"),
        "icon": "M52 100V55M52 55c-3-21-18-34-39-37 3 23 17 36 39 37zM52 65c6-24 24-38 51-42-3 27-21 42-51 42z",
    },
    "sector-g": {
        "label": "Liquid Transportation",
        "colors": ("#08213a", "#0c5a92", "#72c8f1"),
        "icon": "M16 60h78M78 38l24 22-24 22M16 82h48M44 38H16",
    },
    "sector-h": {
        "label": "Crystallization",
        "colors": ("#0d2440", "#5a6ea7", "#c4e6ff"),
        "icon": "M52 10 88 31v42L52 94 16 73V31zM52 10v84M16 31l72 42M88 31 16 73",
    },
    "sector-i": {
        "label": "Water Production",
        "colors": ("#062e48", "#0180a6", "#7adbe8"),
        "icon": "M28 28h48a24 24 0 0 1 0 48H28a24 24 0 0 1 0-48zM32 52h40M54 35v34",
    },
    "multi-sector": {
        "label": "ARBOK Technology",
        "colors": ("#06213b", "#014387", "#0e83ad"),
        "icon": "M52 14a38 38 0 1 0 0 76 38 38 0 0 0 0-76zM52 29v46M29 52h46",
    },
}


def clean_text(value: str) -> str:
    value = re.sub(r"<[^>]+>", " ", value or "")
    value = html.unescape(value)
    value = re.sub(r"\s+", " ", value).strip()
    return value


def split_title(title: str, width: int = 24, max_lines: int = 4):
    title = clean_text(title)
    lines = textwrap.wrap(title, width=width, break_long_words=False, break_on_hyphens=True)
    if len(lines) > max_lines:
        lines = lines[:max_lines]
        lines[-1] = lines[-1].rstrip(".,;:") + "…"
    return lines or ["ARBOK Technology"]


def svg_text_lines(lines, x, y, size, line_height, weight=800, fill="#ffffff"):
    out = []
    for i, line in enumerate(lines):
        out.append(
            f'<text x="{x}" y="{y + i * line_height}" fill="{fill}" '
            f'font-size="{size}" font-weight="{weight}" font-family="Manrope, Arial, sans-serif">'
            f"{html.escape(line)}</text>"
        )
    return "\n".join(out)


def make_svg(item, term_map):
    title = clean_text(item["title"]["rendered"])
    slug = item["slug"]
    sector_ids = item.get("technology_sector") or []
    sector_slug = term_map.get(str(sector_ids[0]), {}).get("slug", "multi-sector") if sector_ids else "multi-sector"
    theme = SECTOR_THEMES.get(sector_slug, SECTOR_THEMES["multi-sector"])
    label = clean_text(theme["label"])
    c1, c2, c3 = theme["colors"]
    seed = sum(ord(c) for c in slug)
    angle = seed % 360
    offset = 18 + seed % 42
    title_lines = split_title(title)
    title_block = svg_text_lines(title_lines, 84, 430, 54 if len(title_lines) <= 3 else 48, 60)
    circles = []
    for i in range(18):
        cx = 120 + ((seed * (i + 7)) % 960)
        cy = 90 + ((seed * (i + 13)) % 560)
        r = 2 + ((seed + i * 11) % 8)
        op = 0.10 + ((i % 5) * 0.035)
        circles.append(f'<circle cx="{cx}" cy="{cy}" r="{r}" fill="#ffffff" opacity="{op:.2f}"/>')
    waves = []
    for i in range(4):
        y = 168 + i * 76 + (seed % 24)
        d = f"M{-80 + i*25} {y} C 160 {y-80}, 320 {y+80}, 560 {y} S 940 {y-70}, 1280 {y+10}"
        waves.append(f'<path d="{d}" fill="none" stroke="#ffffff" stroke-width="{1.2 + i*.4}" opacity="{0.08 + i*.035:.2f}"/>')
    return f'''<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="750" viewBox="0 0 1200 750" role="img" aria-labelledby="title desc">
  <title id="title">{html.escape(title)} — {html.escape(label)}</title>
  <desc id="desc">Neutral ARBOK technology visual for {html.escape(title)} in the {html.escape(label)} sector.</desc>
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1" gradientTransform="rotate({angle})">
      <stop offset="0%" stop-color="{c1}"/>
      <stop offset="56%" stop-color="{c2}"/>
      <stop offset="100%" stop-color="{c3}"/>
    </linearGradient>
    <radialGradient id="glow" cx="68%" cy="24%" r="64%">
      <stop offset="0%" stop-color="#ffffff" stop-opacity=".30"/>
      <stop offset="52%" stop-color="#75d8f1" stop-opacity=".10"/>
      <stop offset="100%" stop-color="#000000" stop-opacity="0"/>
    </radialGradient>
    <pattern id="grid" width="44" height="44" patternUnits="userSpaceOnUse">
      <path d="M44 0H0V44" fill="none" stroke="#ffffff" stroke-opacity=".09" stroke-width="1"/>
    </pattern>
    <filter id="shadow" x="-30%" y="-30%" width="160%" height="160%">
      <feDropShadow dx="0" dy="22" stdDeviation="22" flood-color="#001a33" flood-opacity=".28"/>
    </filter>
  </defs>
  <rect width="1200" height="750" fill="url(#bg)"/>
  <rect width="1200" height="750" fill="url(#grid)" opacity=".95"/>
  <rect width="1200" height="750" fill="url(#glow)"/>
  <g opacity=".92">{''.join(waves)}</g>
  <circle cx="{900-offset}" cy="{245+offset}" r="250" fill="none" stroke="#ffffff" stroke-opacity=".20" stroke-width="2"/>
  <circle cx="{900-offset}" cy="{245+offset}" r="152" fill="none" stroke="#ffffff" stroke-opacity=".13" stroke-width="32"/>
  <g>{''.join(circles)}</g>
  <g transform="translate(856 154) scale(2.25)" fill="none" stroke="#ffffff" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" opacity=".72" filter="url(#shadow)">
    <path d="{theme['icon']}"/>
  </g>
  <rect x="84" y="82" width="320" height="46" rx="23" fill="#ffffff" opacity=".11" stroke="#ffffff" stroke-opacity=".22"/>
  <text x="108" y="112" fill="#d8f5ff" font-size="18" font-weight="800" letter-spacing="3" font-family="Manrope, Arial, sans-serif">{html.escape(label.upper())}</text>
  {title_block}
  <text x="86" y="664" fill="#c8e5f0" font-size="19" font-weight="800" letter-spacing="4" font-family="Manrope, Arial, sans-serif">STRATEGIC RESEARCH INSTITUTE ARBOK</text>
  <line x1="84" y1="690" x2="1116" y2="690" stroke="#ffffff" stroke-opacity=".22"/>
</svg>
'''


def main():
    with DATA.open() as f:
        data = json.load(f)
    terms = {str(t["id"]): t for t in data["sectors"]}
    OUT.mkdir(parents=True, exist_ok=True)
    count = 0
    manifest = []
    for item in data["technologies"]:
        slug = item["slug"]
        svg = make_svg(item, terms)
        path = OUT / f"{slug}.svg"
        path.write_text(svg, encoding="utf-8")
        title = clean_text(item["title"]["rendered"])
        manifest.append({"slug": slug, "title": title, "file": f"assets/images/technology-visuals/{slug}.svg"})
        count += 1
    (OUT / "manifest.json").write_text(json.dumps(manifest, indent=2, ensure_ascii=False), encoding="utf-8")
    print(f"Generated {count} technology visuals in {OUT}")


if __name__ == "__main__":
    main()
