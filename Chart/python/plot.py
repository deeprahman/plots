import pandas as pd
import io
import base64
import sys
import matplotlib.pyplot as plt, mpld3
from matplotlib.ticker import MultipleLocator

index_var = sys.argv[1]
param_1 = sys.argv[2]
param_2 = sys.argv[3]
color_param_2 = sys.argv[4]
data_file = sys.argv[5]

# index_var = 'Date'
# param_1 = 'Open'
# param_2 = 'T10Y3M'
# color_param_2 = 'red'

def convToBase64(fig, fmt = 'svg'):
    img = io.BytesIO()
    fig.savefig(img, format=fmt,bbox_inches='tight')
    img.seek(0)
    encoded = base64.b64encode(img.getvalue())
    # return '<img src="data:image/svg;base64, {}">'.format(encoded.decode('utf-8'))
    return '<img src="data:image/svg+xml;base64, {}">'.format(encoded.decode('utf-8'))



# Stock Ticker
nvg_stock_ticker = param_2  # Valid values: 'Open', 'Close','Adj Close','High', 'Low'
# NVG line color
nvg_line_color = color_param_2 # Put a color name e.g. 'red', 'green', 'black','brown', etc.


df = pd.read_csv(data_file, index_col=index_var,parse_dates=True)
fig, ax1 = plt.subplots(figsize = (16,6))
ax2 = ax1.twinx()
ax1.set_title("10-Year Treasury Constant Maturity  and Nuveen AMT-Free Municipal Credit Income Fund")

# t10ym.plot(color='red')
# ax1.yaxis.set_major_locator(MultipleLocator(100))
ax1.plot(df[param_1],color='blue')
ax2.plot(df[nvg_stock_ticker],color=nvg_line_color)
ax1.set_xlabel('Dates (Daily)')
ax1.legend([param_1])
ax2.legend(['NVG - '+nvg_stock_ticker])
ax1.set_ylabel("Percent", color='blue')
ax2.set_ylabel("Stock Value in USD", color=nvg_line_color)
x =convToBase64(fig)
print(x)

# plt.tight_layout()
# plt.show()
# mpld3.show()
# print(mpld3.fig_to_html(fig))
# x = mpld3.fig_to_html(fig)

# plt.show()
# f = open("index.html", "a")
# f.write(x)
# f.close()

# fig, ax1 = plt.subplots(figsize = (15,8))
# ax2 = ax1.twinx()
# ax1.set_title("10-Year Treasury Constant Maturity  and Nuveen AMT-Free Municipal Credit Income Fund")

# # t10ym.plot(color='red')
# # ax1.yaxis.set_major_locator(MultipleLocator(100))
# ax1.plot(df['T10Y3M'],color='blue')
# ax2.plot(df[nvg_stock_ticker],color=nvg_line_color)
# ax1.set_xlabel('Dates (Daily)')
# ax1.legend(['T10Y3M'])
# ax2.legend(['NVG - '+nvg_stock_ticker])
# ax1.set_ylabel("Percent", color='blue')
# ax2.set_ylabel("Stock Value in USD", color='red')
# plt.tight_layout()
# # plt.show()
# print(mpld3.fig_to_html(fig))
# x = mpld3.fig_to_html(fig)