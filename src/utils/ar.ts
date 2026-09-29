const AR_DIGITS = '٠١٢٣٤٥٦٧٨٩';

export function ar(n: string | number): string {
  return String(n).replace(/\d/g, (d) => AR_DIGITS[Number(d)]);
}

/** Arabic digits with a zero-width break so iOS Safari won't treat them as a phone link */
export function arRegNo(n: string | number): string {
  const digits = ar(n);
  const mid = Math.floor(digits.length / 2);
  return digits.slice(0, mid) + '\u200C' + digits.slice(mid);
}
