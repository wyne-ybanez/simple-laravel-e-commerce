export function currencyEU(value) {
  return new Intl.NumberFormat('en-DE', {style: 'currency', currency: 'EUR'})
    .format(value);
}

export function currencyUSD(value) {
  return new Intl.NumberFormat('en-US', {style: 'currency', currency: 'USD'})
    .format(value);
}
